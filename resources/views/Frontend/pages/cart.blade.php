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
                                                            <img width="100px" height="100px" style="object-fit: contain" src="{{ asset('upload/' . $item['image']) }}" alt="{{ $item['name'] }}" />
                                                        </div>
                                                        <div class="product-name">{{ $item['name'] }}</div>
                                                    </td>
                                                    <td>{{ $item['price'] }}</td>
                                                    <td>{{ $item['quantity'] }}</td>
                                                    <td>{{ $item['total_price'] }}</td>
                                                    <td>
                                                        <a href="" data-product-id="{{ $item['id'] }}" class="remove-from-cart">
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
                                
                                    <a href="{{ route('checkout.front') }}" class="btn btn-primary">Proceed to Checkout</a>
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
