<div id="sub-header">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="social-icons">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#"><i class="fa fa-behance"></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 hidden-sm">
                <div class="right-info">
                    <ul>
                        <li>Call us: <em>570-694-4002</em></li>
                        @if (auth()->check())
                            @if (auth()->user()->role == 'User')
                                <li><a href="{{ route('user.dashboard') }}">{{ auth()->user()->name }}</a></li>
                            @else
                                <li><a href="{{ route('admin.dashboard') }}">{{ auth()->user()->name }}</a></li>
                            @endif
                        @else
                            <li><a href="{{ route('register.front') }}">Register</a></li>
                            <li><a href="{{ route('login.web') }}">login</a></li>
                            @endif
                            <li><i class="fa fa-shopping-cart " aria-hidden="true"></i><span class="header-mini-cart">{{ isset($data['cart']['items']) ? count($data['cart']['items']) : 0 }}</span></li>



                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<header class="site-header">
    <div id="main-header" class="main-header header-sticky">
        <div class="inner-header container clearfix">
            <div class="logo">
                <a href="{{ route('index.front') }}"><img src="{{ URL::asset('frontassets/images/logo.png') }}"
                        alt=""></a>
            </div>
            <div class="header-right-toggle pull-right hidden-md hidden-lg">
                <a href="javascript:void(0)" class="side-menu-button"><i class="fa fa-bars"></i></a>
            </div>
            <nav class="main-navigation text-left hidden-xs hidden-sm">
                <ul>
                    <li><a href="{{ route('index.front') }}">Home</a></li>
                    <li><a href="{{ route('about.front') }}">About Us</a></li>
                    <li><a href="{{ route('listing.front') }}">Car Listing</a></li>
                    <li><a href="{{ route('shop.front') }}">Shop</a></li>
                    <li><a href="{{ route('cart.front') }}">Cart</a></li>
                    {{-- <li><a href="{{route('listing.front')}}">Listing</a></li>
                    <li><a href="{{route('contact.front')}}">Contact</a></li> --}}

                </ul>
            </nav>
        </div>
    </div>
</header>
