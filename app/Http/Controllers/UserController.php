<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\CarCategory;
use App\Models\CarBrands;
use App\Models\CarBids;
use App\Models\UserRegistrationAmount;
use App\Models\UserRegistrationPayment;
use Illuminate\Support\Facades\Auth;
use Stripe;


class UserController extends Controller
{
    public function Dashboard(Request $request)
    {
        $title = "Dashboard";
        $user = Auth::user();
        $totalCars = Car::where('user_id', $user->id)->count();
        $soldCars = Car::where('user_id', $user->id)->where('is_sold', true)->count();
        $total_profit = Car::where('user_id', $user->id)
            ->whereHas('bids', function ($query) {
                $query->where('is_winner', true)
                ->where('is_paid', true);
            })->get()->sum(function ($car) {
                return $car->bids()
                ->where('is_winner', true)
                ->where('is_paid', true)
                ->sum('bid_amount') - $car->price;
            });
        $totalBids = CarBids::where('user_id', $user->id)
            ->where('is_winner', false)
            ->count();
        $carsBought = Car::whereHas('bids', function ($query) use ($user) {
            $query->where('user_id', $user->id)
            ->where('is_winner', true)
            ->where('is_paid', true);
        })->count();
        $userRegistrationAmount = UserRegistrationAmount::first();
        return view("user.dashboard", compact("title", "totalCars", "soldCars", "total_profit", "totalBids", "carsBought", 'userRegistrationAmount'));
    }

    public function view_bidding_result(Request $request)
    {
        $data['title'] = "Your Bids won";
        $user = $request->user(); // Get the authenticated user
        // Retrieve the cars that the user has won
        $data['user_cars'] = Car::whereHas('bids', function ($query) use ($user) {
            $query->where('user_id', $user->id)->where(['is_winner' => true, 'is_rejected' => false]);
        })->with(['category', 'brand', 'bids' => function ($query) use ($user) {
            $query->where('user_id', $user->id)->where(['is_winner' => true, 'is_rejected' => false])->get();
        }])->get();
        return view('user.bidwinner')->with(['data' => $data]);
    }


    public function view_order(Request $request)
    {
        $data['title'] = "View ordered Car";
        $user = $request->user(); // Get the authenticated user
        // Retrieve the cars that the user has won
        $data['user_car'] = Car::whereHas('bids', function ($query) use ($user, $request) {
            $query->where('user_id', $user->id)
                ->where('car_id', $request->id)
                ->where(['is_winner' => true, 'is_rejected' => false]);
        })
            ->with(['category', 'user', 'brand', 'bids' => function ($query) use ($user, $request) {
                $query->where('user_id', $user->id)
                    ->where('car_id', $request->id)
                    ->where(['is_winner' => true, 'is_rejected' => false])->first();
            }])
            ->findOrFail($request->id);
        return view('user.vieworder')->with(['data' => $data]);
    }

    public function reject_car(Request $request)
    {
        $user = $request->user();
        $car_id = $request->query('id');
        $car_bid = CarBids::where('car_id', $car_id)
            ->where('user_id', $user->id)
            ->where('is_winner', true)
            ->where('is_rejected', false)
            ->first();
        if ($car_bid) {
            $car_bid->is_rejected = true;
            $car_bid->save();
            return redirect()->back()->with('reject', 'You have the car rejected successfully.');
        } else {
            return redirect()->back()->with('error', 'Car not found or already rejected.');
        }
    }

    public function buy_car(Request $request)
    {
        $data['title'] = "Payment";
        $user = $request->user();
        $car = Car::findOrFail($request->id);
        // Retrieve the highest bid for the car that the user has won
        $highestBid = CarBids::where([
            'user_id' => $user->id,
            'car_id' => $request->id,
            'is_winner' => true,
            'is_rejected' => false,
        ])->orderByDesc('bid_amount')->first();
        if (!$highestBid) {
            abort(404);
        }
        if ($request->isMethod('POST')) {
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            $charge = \Stripe\Charge::create([
                'amount' => $highestBid->bid_amount * 100, // Convert amount to cents
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment for car purchase',
                'receipt_email' => $user->email,
                'metadata' => [
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'car_id' => $request->id,
                    'bid_id' => $highestBid->id,
                ],
            ]);
            // Update the bid as paid
            if ($charge) {
                $highestBid->update([
                    'is_paid' => true,
                    'paid_at' => now(),
                ]);
                $car->is_sold = 1;
                $car->save();
            }
            return redirect()->route('user.wonbids')->with('success', 'Thank you for your payment');
        }
        return view('user.buycar')->with(['data' => $data, 'bid' => $highestBid]);
    }

    public function initial_payment(Request $request)
    {
        $user = User::findOrFail($request->user()->id);
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'stripeToken' => 'required',
            ]);
            // Get UserRegistrationAmount
            $userRegistrationAmount = UserRegistrationAmount::first();
            $registrationAmount = $userRegistrationAmount->amount;
            // Charge user registration amount using Stripe
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $charge = \Stripe\Charge::create([
                'amount' => $registrationAmount * 100, // Convert amount to cents
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment for user registration',
                'receipt_email' => $user->email,
                'metadata' => [
                    'user_id' => $user->id,
                    'name' => $user->name,
                ],
            ]);
            // Create user registration payment record
            if ($charge) {
                UserRegistrationPayment::create([
                    'paid_amount' => $registrationAmount,
                    'user_id' => $user->id,
                ]);
                $user->is_initial_paid = true;
                $user->save();
                return redirect()->to(route('user.dashboard'))->with('success', "Initial Amount paid successfully!");
            }
        }
    }
}
