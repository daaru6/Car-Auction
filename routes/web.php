<?php

use App\Http\Controllers\AuthController;

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Controllers\UserController;

use App\Http\Controllers\CarController;

use App\Http\Controllers\ProductController;

use App\Http\Controllers\Frontend\FrontendController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [FrontendController::class, "index"])->name("index.front");

Route::get('/about-us', [FrontendController::class, "about"])->name("about.front");

//Car Biding

Route::get('/listing', [FrontendController::class, "listing"])->name("listing.front");

Route::get('/listing/car/{slug}/', [FrontendController::class, "listing_detail"])->name("listing.detail.front")->where(['id' => '[0-9]+']);

Route::post('/listing/bid/{slug}/', [FrontendController::class, "post_bid"])->name("listing.detail.bid.front")->middleware(['initial.payment', 'user.active']);

Route::post('/listing/comment', [FrontendController::class, "post_comment"])->name("listing.detail.comment.front");

//Shop
Route::get('/shop', [FrontendController::class, "shop"])->name("shop.front");

Route::get('/shop/product/{slug}/', [FrontendController::class, "product"])->name("shop.product.front")->where(['id' => '[0-9]+']);

Route::get('/product/add-to-cart', [FrontendController::class, "add_to_cart"])->name("add_to_cart.front");

Route::get('/product/remove-from-cart', [FrontendController::class, "remove_from_cart"])->name("remove_from_cart.front");

Route::post('/product/{productId}/review', [ProductController::class, 'add_review'])->name('product.add_review.front');

Route::get('/cart', [FrontendController::class, "cart"])->name("cart.front");

Route::match(['GET', 'POST'], '/checkout', [FrontendController::class, "checkout"])->name("checkout.front");


Route::match(["GET", "POST"], '/register', [FrontendController::class, "register"])->name("register.front");

Route::get('/login', function () {

    return view("login");
})->name("login.web");

Route::post('/login', [AuthController::class, "login"])->name('loginpost');


Route::middleware(['auth', 'role:Admin'])->group(function () {

    Route::prefix("/admin")->group(function () {

        //Admin Controller Routes

        Route::get('/dashboard', [AdminController::class, "adminDashboard"])->name('admin.dashboard');

        Route::get('/user', [AdminController::class, "user"])->name('admin.agents');

        Route::match(["GET", "POST"], '/new-user', [AdminController::class, "userNew"])->name('admin.agentNew');

        Route::match(["GET", "POST"], '/user-edit/{id}', [AdminController::class, "userEdit"])->name('admin.agentEdit');

        Route::get('/agent-delete/{id}', [AdminController::class, "userDelete"])->name('admin.agentDelete');

        Route::get('/update-status', [AdminController::class, "active_user"])->name('admin.activeuser');

        Route::prefix("/product")->group(function () {

            Route::get('/all', [ProductController::class, "index"])->name('admin.product.index');

            Route::get('/add', [ProductController::class, "create"])->name('admin.product.create');
            Route::post('/add', [ProductController::class, "store"])->name('admin.product.store');

            Route::get('/edit', [ProductController::class, "edit"])->name('admin.product.edit')->where('id', '[0-9]+');
            Route::post('/edit', [ProductController::class, "update"])->name('admin.product.update')->where('id', '[0-9]+');

            Route::get('/delete', [ProductController::class, "destroy"])->name('admin.product.destroy')->where('id', '[0-9]+');
        });

        Route::match(["GET", "POST"], '/user-registration-amount', [AdminController::class, "user_registration_amount"])->name('admin.userregistrationamount');
        // Car Controller Routes

        Route::prefix("/car")->group(function () {

            // Category
            Route::match(["GET", "POST"], '/add-category', [CarController::class, "add_category"])->name('admin.car.category.create');

            Route::match(["GET", "POST"], '/edit-category', [CarController::class, "edit_category"])->name('admin.car.category.edit')->where('id', '[0-9]+');

            Route::get('/delete-category', [CarController::class, "delete_category"])->name('admin.car.category.del')->where('id', '[0-9]+');

            // Category Brand
            Route::match(["GET", "POST"], '/add-brand', [CarController::class, "add_brand"])->name('admin.car.brand.create');

            Route::match(["GET", "POST"], '/edit-brand', [CarController::class, "edit_brand"])->name('admin.car.brand.edit')->where('id', '[0-9]+');

            Route::get('/delete-brand', [CarController::class, "delete_brand"])->name('admin.car.brand.del')->where('id', '[0-9]+');
        });

        Route::prefix("/orders")->group(function () {

            Route::get('/all', [AdminController::class, "orders"])->name('admin.order.all');
            Route::get('/detail', [AdminController::class, "order_detail"])->name('admin.order.detail');

            Route::get('/update-order-status', [AdminController::class, "update_order_status"])->name('admin.order.status');

        });
    });
});


Route::get('user/dashboard', [UserController::class, "Dashboard"])->name('user.dashboard')->middleware(['auth', 'role:User', 'user.active']);

Route::post('user/initial-payment', [UserController::class, "initial_payment"])->name('user.initialpayment')->middleware(['auth', 'role:User', 'user.active']);

Route::middleware(['auth', 'role:User', 'initial.payment', 'user.active'])->group(function () {

    Route::prefix("/user")->group(function () {

        // Car Controller Routes

        Route::prefix("/car")->group(function () {

            Route::match(["GET", "POST"], '/add-car', [CarController::class, "add_car"])->name('user.car.create');

            Route::match(["GET", "POST"], '/edit-car', [CarController::class, "edit_car"])->name('user.car.edit')->where('id', '[0-9]+');

            Route::get('/delete-car', [CarController::class, "delete_car"])->name('user.car.del')->where('id', '[0-9]+');

            Route::get('/delete-car-gallery-image', [CarController::class, "delete_car_gallery_image"])->name('user.car.gallery.del')->where('id', '[0-9]+');

            Route::get('/all-cars', [CarController::class, "user_cars"])->name('user.car.all');
        });

        Route::get('/view-bids-won', [UserController::class, "view_bidding_result"])->name('user.wonbids');

        Route::get('/view-order', [UserController::class, "view_order"])->name('user.vieworder');

        Route::match(["GET", "POST"], '/view-bids-won/payment/{slug}', [UserController::class, "buy_car"])->name('user.payment')->where(['id' => '[0-9]+']);

        Route::get('/reject-car', [UserController::class, "reject_car"])->name('user.car.reject')->where('id', '[0-9]+');
    });
});

Route::get('/logout', [AuthController::class, "logout"])->name('logout');
