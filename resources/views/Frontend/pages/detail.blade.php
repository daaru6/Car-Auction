<Style>
    #page-heading {

        background-image: url(https://wallpapercave.com/wp/NGzwTao.jpg) !important;

    }

    .single-blog .leave-comment {
        margin-top: 0px !important;
    }

    .sidebar-menu-container {
        position: relative;
        overflow: visible !important;
    }

    .sidebar-menu-push {
        position: relative;
        left: 0;
        z-index: 9999;
        height: auto !important;
        -webkit-transition: -webkit-transform 0.5s;
        transition: transform 0.5s;
    }
</Style>

@extends('Frontend.layouts.app', ['page_title' => $data['page_title']])

@section('content')

    <div class="sidebar-menu-container" id="sidebar-menu-container">

        <div class="sidebar-menu-push">

            <div class="sidebar-menu-overlay"></div>

            <div class="sidebar-menu-inner">

                @include('Frontend.layouts.nav')

                <div id="page-heading">

                    <div class="container">

                        <div class="row">

                            <div class="col-md-12 text-center">

                                <h1>Listing Results</h1>

                                <div class="line"></div>

                                <span>Praesent volutpat nisi sed imperdiet facilisis felis turpis fermentum lectus</span>

                                <div class="page-active">

                                    <ul>

                                        <li><a href="index.html">Home</a></li>

                                        <li><i class="fa fa-dot-circle-o"></i></li>

                                        <li><a href="listin-right.html">Listing Results</a></li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                <section class="car-details single-blog">

                    <div class="container">

                        @if (Session::has('success'))
                            <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                                {{ Session::get('success') }}</p>
                        @endif

                        @if (Session::has('error'))
                            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">
                                {{ Session::get('error') }}</p>
                        @endif

                        <div class="row">

                            <div id="single-car" class="col-md-8">

                                <div class="up-content clearfix">

                                    <h2>{{ $data['car']['car_name'] }}</h2>

                                    @if (strtotime($data['car']['expiry_date']) <= time())
                                        <h2 class="displaybid">Bidding close at Rs :
                                            {{ isset($data['car']['highestBid']) ? $data['car']['highestBid']['bid_amount'] : $data['car']['price'] }}
                                        </h2>
                                    @else
                                        <h2 class="displaybid">
                                            {{ isset($data['car']['highestBid']) ? 'Current bid Rs :' . $data['car']['highestBid']['bid_amount'] : 'Rs : ' . $data['car']['price'] }}
                                        </h2>
                                    @endif

                                </div>

                                <div class="flexslider">

                                    <ul class="slides">

                                        <li data-thumb="{{ asset('upload/' . $data['car']['image']) }}">

                                            <img src="{{ asset('upload/' . $data['car']['image']) }}" alt="" />

                                        </li>

                                        @foreach ($data['car']['gallery'] as $gallery)
                                            <li data-thumb="{{ asset('upload/' . $gallery->image) }}">

                                                <img width="60px" src="{{ asset('upload/' . $gallery->image) }}"
                                                    alt="" />

                                            </li>
                                        @endforeach

                                    </ul>

                                </div>

                                <div class="tab">

                                    <div class="tabs">

                                        <ul class="tab-links">

                                            <li class="active"><a href="#tab1">Comments</a></li>

                                            <li class=""><a href="#tab2">Description</a></li>

                                            <li><a href="#tab4">Contact dealer</a></li>

                                        </ul>

                                        <div class="tab-content">

                                            <div id="tab1" class="tab active">



                                                <div class="comments">
                                                    <h2>{{ count($data['car']['comments']) }} comments on this post</h2>
                                                    @foreach ($data['car']['comments'] as $comment)
                                                        <div class="comment-item">
                                                            <img src="http://dummyimage.com/55x55/cccccc/fff.jpg"
                                                                alt="">

                                                            <h4>{{ $comment->user ? $comment->user->name : $comment->name }}
                                                            </h4>
                                                            <span><i
                                                                    class="fa fa-clock-o"></i>{{ $comment->created_at->diffForHumans() }}</span>
                                                            <p>{{ $comment->comment }}</p>
                                                        </div>
                                                    @endforeach
                                                </div>

                                                @if (Auth::check() || session('name'))
                                                    <form method="POST"
                                                        action="{{ route('listing.detail.comment.front', ['car_id' => $data['car']['car_id']]) }} ">
                                                        <div class="leave-comment">
                                                            @csrf

                                                            <div class="col-md-12">
                                                                <textarea id="message" class="comment" name="comment" placeholder="Your Message"></textarea>
                                                            </div>
                                                            <br>
                                                            <button class="btn btn-primary" type="submit">Post Comment
                                                            </button>
                                                        </div>
                                                    </form>
                                                @else
                                                    <form method="POST"
                                                        action="{{ route('listing.detail.comment.front', ['car_id' => $data['car']['car_id']]) }} ">
                                                        <div class="leave-comment">
                                                            @csrf

                                                            <div class="col-md-6">
                                                                <input type="text" class="name form-control"
                                                                    name="name" placeholder="Your Name" value="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" class="name form-control"
                                                                    name="email" placeholder="Your Email" value="">
                                                            </div>
                                                            <div class="col-md-12">
                                                                <textarea id="message" class="comment form-control" name="comment" placeholder="Your Message"></textarea>
                                                            </div>
                                                            <br>
                                                        </div>
                                                        <button class="btn btn-primary" type="submit">Post Comment
                                                        </button>
                                                    </form>
                                                @endif
                                                {{-- <form method="POST" action="">
                                                    <div class="leave-comment">
                                                        <h2>Leave a comment</h2>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" class="name" name="s"
                                                                    placeholder="Your Name" value="">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" class="name" name="s"
                                                                    placeholder="Your Email" value="">
                                                            </div>

                                                            <div class="col-md-12">
                                                                <textarea id="message" class="comment" name="message" placeholder="Your Message"></textarea>
                                                            </div>
                                                            <div class="col-md-12">
                                                                <div class="advanced-button">
                                                                    <a href="#">Submit Now<i
                                                                            class="fa fa-paper-plane"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form> --}}


                                            </div>
                                            <div id="tab2" class="tab ">

                                                <p>{{ $data['car']['description'] }}</p>

                                            </div>

                                            <div id="tab4" class="tab">

                                                <p>Name : {{ $data['car']['user']['name'] }} </p>

                                                <p>Email : {{ $data['car']['user']['email'] }}</p>


                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>



                            <div id="left-info" class="col-md-4">

                                <div class="details">

                                    <div class="head-side-bar">

                                        <h4>Vehicle Details</h4>

                                    </div>

                                    <div class="list-info">

                                        <ul>

                                            <li><span>Make:</span>{{ $data['car']['brand']['brand_name'] }}</li>

                                            <li><span>Category:</span>{{ $data['car']['category']['category_name'] }}</li>

                                            <li><span>Transmission:</span>{{ $data['car']['car_type'] === 0 ? 'Manual' : 'Automatic' }}
                                            </li>

                                            <li><span>Starting Price:</span>RS {{ $data['car']['price'] }}</li>

                                            <li><span>Time:</span><span style="color:#336699;font-weight: bold; "
                                                    id="countdown"></span></li>


                                        </ul>
                                        @if (Auth::check())

                                            @if ($data['car']['user']['id'] == Auth::id())
                                                <h4 style="color:#336699; font-weight: bold;">It's your car!</h4>
                                            @else
                                                @if (strtotime($data['car']['expiry_date']) <= time())
                                                    <h4 style="color:#FF0000; font-weight: bold;">Bidding is over.</h4>
                                                @else
                                                    <h4 style="color:#336699; font-weight: bold;">Place your Bid:</h4>

                                                    <div class="quantity buttons_added">

                                                        <form
                                                            action="{{ route('listing.detail.bid.front', ['slug' => $data['car']['slug'], 'car_id' => $data['car']['car_id']]) }}"
                                                            method="post">

                                                            @csrf

                                                            <input type="button" value="-" class="minus">

                                                            <input type="number" name="bid_amount"
                                                                data-auction-id="4331"
                                                                value="{{ isset($data['car']['highestBid']) ? $data['car']['highestBid']['bid_amount'] : $data['car']['price'] }}"
                                                                min="{{ isset($data['car']['highestBid']) ? $data['car']['highestBid']['bid_amount'] : $data['car']['price'] }}"
                                                                step="100" size="3" title="bid"
                                                                autocomplete="off" class="input-text qty bid text left">

                                                            <input type="button" value="+" class="plus">

                                                            <br>

                                                            <button style="margin-top: 10px"
                                                                class="btn btn-warning text-dark"
                                                                type="submit">Bid</button>

                                                        </form>

                                                    </div>

                                                    @isset($data['car']['currentBid'])
                                                        <p style="color:#336699; font-weight: bold;">Your last bid was

                                                            {{ $data['car']['currentBid']['bid_amount'] }}</p>
                                                    @endisset
                                                @endif
                                            @endif
                                        @else
                                            <h4 style="color:#336699; font-weight: bold;">You need to log in or register to
                                                bid.</h4>

                                        @endif

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

            </div>

        </div>

        <script>
            // Set the date and time to countdown to
            var targetDate = new Date(Date.parse("{{ $data['car']['expiry_date'] }}"));

            // Update the countdown every second
            setInterval(function() {
                // Calculate the remaining time in milliseconds
                var now = new Date();

                var timeRemaining = targetDate.getTime() - now.getTime();

                if (timeRemaining <= 0) {
                    document.getElementById("countdown").innerHTML = "Time is ended";
                    return;
                }

                // Calculate the remaining time in months, days, hours, minutes, and seconds
                var months = Math.floor(timeRemaining / (1000 * 60 * 60 * 24 * 30));

                var days = Math.floor((timeRemaining % (1000 * 60 * 60 * 24 * 30)) / (1000 * 60 * 60 * 24));

                var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));

                var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));

                var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                // Display the remaining time in the HTML element with the ID "countdown"
                var countdownText = "";

                if (months > 0) {
                    countdownText += months + " months, ";
                }

                if (days > 0) {
                    countdownText += days + " days, ";
                }

                if (hours > 0) {
                    countdownText += hours + " hours, ";
                }

                if (minutes > 0) {
                    countdownText += minutes + " minutes, ";
                }
                if (seconds > 0) {
                    countdownText += seconds + " seconds";;
                }

                document.getElementById("countdown").innerHTML = countdownText;
            }, 1000);



            $(document).ready(function() {
                // Get the input field
                var inputField = $("input[name='bid_amount']");

                // Get the minimum value from the "min" attribute
                var minValue = parseInt(inputField.attr("min"));

                // Handle the click event for the plus button
                $(".plus").click(function() {
                    // Get the current value of the input field
                    var currentValue = parseInt(inputField.val());

                    // Increase the value by the step amount (in this case, 2)
                    var newValue = currentValue + 100;

                    // Make sure the new value is not below the minimum value
                    if (newValue < minValue) {

                        newValue = minValue;
                    }

                    // Set the new value of the input field
                    inputField.val(newValue);
                });

                // Handle the click event for the minus button
                $(".minus").click(function() {
                    // Get the current value of the input field
                    var currentValue = parseInt(inputField.val());

                    // Decrease the value by the step amount (in this case, 2)
                    var newValue = currentValue - 100;

                    // Make sure the new value is not below the minimum value
                    if (newValue < minValue) {

                        newValue = minValue;
                    }

                    // Set the new value of the input field
                    inputField.val(newValue);
                });
            });
        </script>

        @include('Frontend.layouts.footer')

        @include('Frontend.layouts.mobile-nav')

    </div>

@endsection
