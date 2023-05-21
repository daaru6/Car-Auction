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
                                <h1>{{ $data['product']['name'] }}</h1>
                                <div class="line"></div>
                                <span>Praesent volutpat nisi sed imperdiet facilisis felis turpis fermentum lectus</span>
                                <div class="page-active">
                                    <ul>
                                        <li><a href="index.html">Home</a></li>
                                        <li><i class="fa fa-dot-circle-o"></i></li>
                                        <li><a href="about.html">Product</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Product Detail Page Content -->
                <div class="product-detail-page">
                    <div class="container m-5">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-image" style="text-align: center">
                                    <img width="300px" height="300px" style="object-fit: contain" class="img-thumbnail"
                                        src="{{ asset('upload/' . $data['product']['image']) }}"
                                        alt="{{ $data['product']['name'] }}" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h2>{{ $data['product']['name'] }}</h2>
                                <p>{{ $data['product']['description'] }}</p>
                                <div class="product-price">
                                    <span class="price">{{ $data['product']['price'] }}</span>
                                    <input type="number" id="quantity" min="1" value="1">
                                    <a data-product-id="{{ $data['product']['id'] }}"
                                        class="btn btn-primary add-to-cart-btn">Add
                                        to Cart</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Product Detail Page Content -->






            </div>

        </div>

        @include('Frontend.layouts.footer')
        @include('Frontend.layouts.mobile-nav')



    </div>
@endsection
