<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Models\Car;
use App\Models\CarCategory;
use App\Models\CarBrands;
use App\Models\CarBids;
use App\Models\CarComment;
use App\Models\CarGallery;
use Carbon\Carbon;


class FrontendController extends Controller
{
    public function index()
    {
        $data['page_title'] = "Auction - Car Dealer";
        return view("Frontend.pages.home")->with('data', $data);
    }

    public function about()
    {
        $data['page_title'] = "Auction - About Us";
        return view("Frontend.pages.home")->with('data', $data);
    }

    public function listing(Request $request)
    {
        $data['page_title'] = "Auction - Car Listing";
        $data['all_category'] = CarCategory::all();
        $data['all_brands'] = CarBrands::all();
        $query = Car::with(['category', 'brand'])
            ->when($request->has('car_type'), function ($query) use ($request) {
                switch ($request->input('car_type')) {
                    case 'automatic':
                        $carTypeValue = 1;
                        break;
                    case 'manual':
                        $carTypeValue = 0;
                        break;
                    default:
                        return response()->json(['error' => 'Invalid car type value'], 400);
                }
                $query->where('car_type', '=', $carTypeValue);
            })
            ->when($request->has('brand_name'), function ($query) use ($request) {
                $query->whereHas('brand', function ($query) use ($request) {
                    $query->where('brand_name', '=', $request->input('brand_name'));
                });
            })
            ->when($request->has('category_name'), function ($query) use ($request) {
                $query->whereHas('category', function ($query) use ($request) {
                    $query->where('category_name', '=', $request->input('category_name'));
                });
            })
            ->when($request->has('search'), function ($query) use ($request) {
                $query->where('car_name', 'LIKE', '%' . $request->input('search') . '%');
            });
        $data['cars'] = $query->where('is_sold', false)->paginate(6);
        return view("Frontend.pages.listing")->with('data', $data);
    }

    public function listing_detail(Request $request, $slug)
    {
        $id = $request->query('car_id');

        $data['car'] = Car::with(['gallery', 'category', 'brand', 'user', 'bids' => function ($query) {

            $query->orderBy('bid_amount', 'desc');
        }, 'comments' => function ($query) {

            $query->orderBy('created_at', 'desc');

            $query->with('user');
        }])->findOrFail($id);
        // echo '<pre>';
        // print_r($data['car']);
        // exit;


        $data['car']['highestBid'] = $data['car']->bids->first();

        $user = Auth::user();

        if ($user) {

            $data['car']['currentBid']  = $data['car']->bids->where('user_id', $user->id)->first();
        }


        $data['page_title'] = "Auction - " . $data['car']['car_name'];

        return view("Frontend.pages.detail")->with('data', $data);
    }

    public function post_bid(Request $request)
    {
        if ($request->isMethod('POST')) {
            $user = Auth::user();
            if (!$user) {
                return redirect()->route('login')->with('error', 'You need to login or register to bid.');
            }
            $car = Car::where('slug', $request->slug)->firstOrFail();
            if (!$car) {
                abort(404);
            }
            $lastBid = CarBids::where('car_id', $car->car_id)->where('user_id', $user->id)->orderBy('bid_id', 'desc')->first();
            if ($lastBid && $request->bid_amount <= $lastBid->bid_amount) {
                return redirect()->back()->with('error', 'Your bid amount must be greater than your last bid amount.');
            }
            $highestBid = CarBids::where('car_id', $car->car_id)->max('bid_amount');
            if ($highestBid && $request->bid_amount <= $highestBid) {
                return redirect()->back()->with('error', 'Your bid amount must be greater than the highest bid amount.');
            }
            if ($lastBid && $request->bid_amount >= $highestBid) {
                return redirect()->back()->with('error', 'Your bid amount is highest you not need to bid.');
            }
            $bid = CarBids::updateOrCreate(
                ['car_id' => $car->car_id, 'user_id' => $user->id],
                ['bid_amount' => $request->bid_amount]
            );
            if ($bid->wasRecentlyCreated) {
                return redirect()->back()->with('success', 'Your bid has been placed successfully.');
            } else {
                return redirect()->back()->with('success', 'Your bid has been updated successfully.');
            }
        }
    }

    public function post_comment(Request $request)
    {

        $userId = Auth::id();

        if ($request->isMethod('POST')) {

            if (!$userId) {
                // User is not logged in, so create a comment by a guest user
                $comment = new CarComment([
                    'name' => $request->name,
                    'email' => $request->email,
                    'comment' => $request->comment,
                    'car_id' => $request->car_id,
                ]);
                session(['name' => $request->name]);
            } else {
                // User is logged in, so create a comment by the logged-in user
                $comment = new CarComment([
                    'comment' => $request->comment,
                    'car_id' => $request->car_id,
                    'user_id' => $userId,
                ]);
            }

            $comment->save();

            // Redirect back to the car page after posting the comment
            return redirect()->back()->with('success', 'Comment Posted');
        }
    }

    public function register(Request $request)
    {
        $data['page_title'] = "Auction - Register";
        if ($request->isMethod('POST')) {
            $this->validate($request, [
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'name' => 'required',
            ]);
            $data = $request->toArray();
            $data['role'] = 'User';
            $user = User::create($data);
            auth()->login($user);
            return redirect()->to('user/dashboard')->with('success', "Account successfully registered.");
        }
        return view("Frontend.pages.register")->with('data', $data);
    }
}
