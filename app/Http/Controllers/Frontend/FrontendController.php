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
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CarGallery;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


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

    public function shop(Request $request)
    {
        $data['page_title'] = "Auction - Shop";

        $query = Product::when($request->has('search'), function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request->input('search') . '%');
        });

        $data['products'] = $query->paginate(6);

        return view("Frontend.pages.shop")->with('data', $data);
    }

    public function product(Request $request)
    {

        $data['page_title'] = "Auction - Product";

        $data['product'] = Product::findOrFail($request->id);

        return view("Frontend.pages.product-detail")->with('data', $data);
    }

    public function checkout(Request $request)
    {

        $data['page_title'] = "Auction - Checkout";

        $data['cart'] = session()->get('cart');

        $user = Auth::user();


        if ($request->isMethod('POST')) {

            $this->validate($request, [
                'stripeToken' => 'required',
                'name' => 'required',
                'email' => 'required',
                'address' => 'required',
            ]);

            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            $charge = \Stripe\Charge::create([
                'amount' => $data['cart']['total_price'] * 100, // Convert amount to cents
                'currency' => 'usd',
                'source' => $request->stripeToken,
                'description' => 'Payment for user registration',
                'receipt_email' => isset($user->email) ? $user->email : $request->email,
                'metadata' => [
                    'name' => isset($user->name) ? $user->name : $request->name,
                    'email' => isset($user->email) ? $user->email : $request->email,
                    'address' => $request->address,
                ],
            ]);
            if ($charge) {

                DB::beginTransaction();

                $order =  Order::create([
                    'total_amount' => $data['cart']['total_price'],
                    'user_id' => isset($user->name) ? $user->name : null,
                    'name' => isset($user->name) ? $user->name : $request->name,
                    'email' => isset($user->email) ? $user->email : $request->email,
                    'address' => $request->address,
                    'status' => 'Pending',
                ]);

                foreach ($data['cart']['items'] as $item) {

                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item['id'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                    ]);
                }
                DB::commit();

                return redirect()->to(route('shop.front'))->with('success', "Thank you for you order!");
            }
        }

        return view("Frontend.pages.checkout")->with("data", $data);
    }

    public function cart(Request $request)
    {

        $data['page_title'] = "Auction - Cart";

        $data['cart'] = session()->get('cart');

        return view("Frontend.pages.cart")->with("data", $data);
    }


    public function add_to_cart(Request $request)
    {
        $rules = [
            'id' => 'required',
            'quantity' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response = [
                "status" => 0,
                "message" => $validator->errors()->first(),
            ];

            return response()->json($response, 200);
        }

        $product = Product::find($request->id);

        if (!$product) {
            $response = [
                "status" => 0,
                "message" => 'Product not found!',
            ];

            return response()->json($response, 200);
        }

        $quantity = $request->quantity === 0 ? 1 : $request->quantity;

        $cart = session()->get('cart', [
            'items' => [],
            'total_price' => 0,
        ]);

        $items = collect($cart['items']);

        $items->transform(function ($item) use ($product, $quantity, $request) {

            if ($item['id'] === $product->id) {

                $item['quantity'] = $quantity;

                $item['price'] = $product->price;

                $item['total_price'] = $item['quantity'] * $item['price'];
            }

            return $item;
        });

        $item = [
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'image' => $product->image,
            'quantity' => $quantity,
        ];

        $existingItem = $items->firstWhere('id', $product->id);

        if (!$existingItem) {

            $item['total_price'] = $item['quantity'] * $item['price'];

            $items->push($item);
        }
        $cart['total_price'] = $items->sum('total_price');

        $cart['items'] = $items->toArray();

        session()->put('cart', $cart);

        $response = [
            "status" => 1,
            "message" => 'Product added to cart!',
            "cart" => $cart,
        ];

        return response()->json($response, 200);
    }

    public function remove_from_cart(Request $request)
    {
        $rules = [
            'id' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response = [
                "status" => 0,
                "message" => $validator->errors()->first(),
            ];

            return response()->json($response, 200);
        }

        $product_id = $request->input('id');

        $cart = session()->get('cart');

        if (isset($cart['items'])) {
            foreach ($cart['items'] as $index => $item) {
                if ($item['id'] == $product_id) {
                    unset($cart['items'][$index]);
                    $cart['total_price'] -= $item['total_price'];
                    break;
                }
            }

            $cart['items'] = array_values($cart['items']); // Re-index the remaining items

            session()->put('cart', $cart);

            $response = [
                'status' => 1,
                'message' => 'Product removed from cart',
                'cart' => $cart
            ];
        } else {
            $response = [
                'status' => 0,
                'message' => 'No products found in cart'
            ];
        }

        return response()->json($response);
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
