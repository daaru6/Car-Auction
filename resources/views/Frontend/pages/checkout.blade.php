@extends('Frontend.layouts.app', ['page_title' => $data['page_title']])

@section('content')

    <Style>
        #page-heading {
            background-image: url(https://digitalsynopsis.com/wp-content/uploads/2014/06/supercar-wallpapers-bugatti-3.jpg) !important;
        }
    </Style>
    <div class="sidebar-menu-container" id="sidebar-menu-container">

        <div class="sidebar-menu-push">

            <div class="sidebar-menu-overlay"></div>

            <div class="sidebar-menu-inner">



                @include('Frontend.layouts.nav')



                <div id="page-heading">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <h1>Cart</h1>
                                <div class="line"></div>
                                <span>Praesent volutpat nisi sed imperdiet facilisis felis turpis fermentum lectus</span>
                                <div class="page-active">
                                    <ul>
                                        <li><a href="index.html">Home</a></li>
                                        <li><i class="fa fa-dot-circle-o"></i></li>
                                        <li><a href="about.html">Cart</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Checkout Page Content -->
                <div class="checkout-page">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Checkout</h2>
                                <!-- Add your checkout form here -->
            
                                    <p><strong>Card No :</strong> 4242424242424242</p>
            
                                    <p><strong>Month :</strong> Any Future Month</p>
            
                                    <p><strong>Year :</strong> Any Future Year</p>
            
                                    <p><strong>CVC :</strong> 123</p>
            
            
                                <div class="col-md-12">
                                    <div class="row">
            
                                        <div class="col-md-12 ">
            
            
            
                                            <form role="form" action="{{ route('checkout.front') }}" method="POST"
                                                class="require-validation" data-cc-on-file="false"
                                                data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
            
                                                @csrf
            
                                                <div class="form-group">
            
                                                    <label for="fullname">Name</label>
            
                                                    <input type="text" name="name" value="{{ auth()->check() ? auth()->user()->name : '' }}" class="form-control" 
                                                        value="" id="fullname"
                                                        placeholder="Enter Name">
            
                                                </div>
                                                <div class="form-group">
            
                                                    <label for="fullname">Email</label>
            
                                                    <input type="email" name="email" required class="form-control" value="{{ auth()->check() ? auth()->user()->email : '' }}" id="fullname" placeholder="Enter Email">

            
                                                </div>
                                                <div class="form-group">
            
                                                    <label for="name">Address</label>
            
                                                    <input type="text" name="address" class="form-control" 
                                                        value="" id="fullname"
                                                        placeholder="Enter your address here" required>
            
                                                </div>
            
                                                <div class='form-row row'>
            
                                                    <div class='col-xs-12 form-group required'>
            
                                                        <label class='control-label'>Name on Card</label> <input
                                                            class='form-control' size='4' type='text'>
            
                                                    </div>
            
                                                </div>
            
                                                <div class='form-row row'>
            
                                                    <div class='col-xs-12 form-group card required'>
            
                                                        <label class='control-label'>Card Number</label>
            
                                                        <input autocomplete='off' class='form-control card-number' size='20'
                                                            type='tel'>
            
                                                    </div>
            
                                                </div>
            
                                                <div class='form-row row'>
            
                                                    <div class='col-xs-12 col-md-4 form-group cvc required'>
            
                                                        <label class='control-label'>CVC</label>
            
                                                        <input autocomplete='off' class='form-control card-cvc'
                                                            placeholder='ex. 311' size='4' type='number' min='100'
                                                            max='999'>
            
            
                                                    </div>
            
                                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
            
                                                        <label class='control-label'>Expiration Month</label>
            
                                                        <input class='form-control card-expiry-month' placeholder='MM'
                                                            size='2' type='number' min='1' max='12'>
            
            
                                                    </div>
            
                                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
            
                                                        <label class='control-label'>Expiration Year</label>
            
                                                        <input class='form-control card-expiry-year' placeholder='YYYY'
                                                            size='4' type='number' min='2023'>
            
                                                    </div>
            
                                                </div>
            
                                                <div class='form-row row'>
            
                                                    <div class='col-md-12 error form-group hide'>
            
                                                        <div class='alert-danger alert'>Please correct the errors and try
            
                                                            again.</div>
            
                                                    </div>
            
                                                </div>
            
                                                <div class="row">
            
                                                    <div class="col-xs-12">
            
                                                        <button class="btn btn-primary mt-2" type="submit">Pay Now</button>
            
                                                    </div>
            
                                                </div>
            
                                            </form>
            
                                        </div>
            
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Checkout Page Content -->


                <!-- Cart Page Content -->
                <div class="cart-page">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <h2>Your Cart</h2>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Loop through the cart items -->
                                        @isset($data['cart']['items'])
                                            @forelse ($data['cart']['items'] as $item)
                                                <tr>
                                                    <td>
                                                        <div class="product-thumbnail">
                                                            <img width="100px" height="100px" style="object-fit: contain"
                                                                src="{{ asset('upload/' . $item['image']) }}"
                                                                alt="{{ $item['name'] }}" />
                                                        </div>
                                                        <div class="product-name">{{ $item['name'] }}</div>
                                                    </td>
                                                    <td>{{ $item['price'] }}</td>
                                                    <td>{{ $item['quantity'] }}</td>
                                                    <td>{{ $item['total_price'] }}</td>
                                                    <td>
                                                        <a href="" data-product-id="{{ $item['id'] }}"
                                                            class="remove-from-cart">
                                                            <i class="fa fa-times"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="5">Cart is empty</td>
                                                </tr>
                                            @endforelse
                                        @endisset
                                    </tbody>

                                </table>
                                <div class="cart-total">
                                    @isset($data['cart'])
                                        <h3>Total: RS {{ $data['cart']['total_price'] }}</h3>
                                    @endisset
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Cart Page Content -->







            </div>

        </div>

        @include('Frontend.layouts.footer')
        @include('Frontend.layouts.mobile-nav')



    </div>
@endsection
