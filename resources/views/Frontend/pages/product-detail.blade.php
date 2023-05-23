@extends('Frontend.layouts.app', ['page_title' => $data['page_title']])

@section('content')
    <Style>
        #page-heading {
            background-image: url(https://digitalsynopsis.com/wp-content/uploads/2014/06/supercar-wallpapers-bugatti-3.jpg) !important;
        }
    </Style>
    <style>
        .product-reviews {
            margin-top: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
    
        .product-reviews h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }
    
        .product-reviews .review {
            margin-bottom: 15px;
        }
    
        .product-reviews .review p {
            margin: 5px 0;
        }
    
        .product-reviews .review strong {
            font-weight: bold;
        }
    
        .product-reviews form {
            margin-top: 10px;
        }
    
        .product-reviews .form-group {
            margin-bottom: 10px;
        }
    
        .product-reviews label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
    
        .product-reviews select,
        .product-reviews textarea,
        .product-reviews input[type="text"],
        .product-reviews input[type="email"] {
            width: 100%;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
    
        .product-reviews button[type="submit"] {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
    
        .product-reviews button[type="submit"]:hover {
            background-color: #45a049;
        }
        .star-icon {
        color: #FFD700; /* Set the color of the stars */
    }
    </style>
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

                                        <!-- Product Review Section -->
                <div class="product-reviews">
                    <h3>Product Reviews</h3>

                    <!-- Display existing reviews -->
                    @forelse ($data['product']['reviews'] as $review)
                        <div class="review">
                            <p><strong>Rating:</strong> 
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $review->rating)
                                        <span class="star-icon">&#9733;</span>
                                    @else
                                        <span class="star-icon">&#9734;</span>
                                    @endif
                                @endfor
                            </p>
                            <p><strong>Comment:</strong> {{ $review->comment }}</p>
                            @if ($review->user)
                                <p><strong>User:</strong> {{ $review->user->name }}</p>
                            @else
                                <p><strong>Guest:</strong> {{ $review->guest_name }}</p>
                            @endif
                        </div>
                    @empty
                        <p>No reviews available.</p>
                    @endforelse

                    <!-- Add new review form -->
                    @if (auth()->check())
                        <form action="{{ route('product.add_review.front', $data['product']['id']) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="rating">Rating:</label>
                                <select name="rating" id="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="comment">Comment:</label>
                                <textarea name="comment" id="comment" rows="3"></textarea>
                            </div>
                            <button type="submit">Add Review</button>
                        </form>
                    @else
                        <p>Please <a href="{{ route('login.web') }}">log in</a> or provide your name and email to add a review:
                        </p>
                        <form action="{{ route('product.add_review.front', $data['product']['id']) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="rating">Rating:</label>
                                <select name="rating" id="rating">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="comment">Comment:</label>
                                <textarea name="comment" id="comment" rows="3"></textarea>
                            </div>
                            <button type="submit">Add Review</button>
                        </form>
                    @endif
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
