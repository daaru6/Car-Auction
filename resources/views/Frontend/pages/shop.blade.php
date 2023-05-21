<Style>
    #page-heading {
        background-image: url(https://digitalsynopsis.com/wp-content/uploads/2014/06/supercar-wallpapers-bugatti-3.jpg) !important;
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

                                <h1>Shop</h1>

                                <div class="line"></div>

                                <span>Praesent volutpat nisi sed imperdiet facilisis felis turpis fermentum lectus</span>

                                <div class="page-active">

                                    <ul>

                                        <li><a href="index.html">Home</a></li>

                                        <li><i class="fa fa-dot-circle-o"></i></li>

                                        <li><a href="listin-right.html">Shop</a></li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <section class="listing-grid">

                    <div class="container">

                        <div class="row">

                            <div id="listing-cars" class="col-md-9">

                                <div id="featured-cars">

                                    <div class="row">

                                        @forelse ($data['products'] as $product)
                                            <div class="featured-item col-md-4">

                                                <img class="img-fluid img-size"
                                                    src="{{ asset('upload/' . $product->image) }}" alt="">

                                                <div class="down-content">

                                                    <a
                                                        href="{{ route('shop.product.front', ['slug' => $product->slug, 'id' => $product->id]) }}">
                                                        <h2>{{ $product->name }}</h2>
                                                    </a>

                                                    <span>Rs : {{ $product->price }}</span>

                                                    <div class="light-line"></div>

                                                    <p>Donec eu nullas sapien pretium volutpat vel quis turpis.</p>

                                                    <div class="car-info">

                                                        <ul>

                                                            <li class="add-to-cart-btn"
                                                                data-product-id="{{ $product->id }}">
                                                                <i class="fa fa-shopping-cart"></i>
                                                                Add to cart
                                                            </li>

                                                        </ul>

                                                    </div>

                                                </div>

                                            </div>

                                        @empty

                                            NO Result Found
                                        @endforelse

                                    </div>

                                </div>

                                <div class="pagination">

                                    <div class="prev">

                                        @if ($data['products']->onFirstPage())
                                            <span class="disabled"><i class="fa fa-arrow-left"></i>Prev</span>
                                        @else
                                            <a href="{{ $data['products']->previousPageUrl() }}"><i
                                                    class="fa fa-arrow-left"></i>Prev</a>
                                        @endif

                                    </div>

                                    <div class="page-numbers">

                                        <ul>

                                            @if ($data['products']->lastPage() > 1)
                                                @for ($i = 1; $i <= $data['products']->lastPage(); $i++)
                                                    @if ($i == $data['products']->currentPage())
                                                        <li class="active"><a href="#">{{ $i }}</a></li>
                                                    @else
                                                        <li>

                                                            <a
                                                                href="{{ $data['products']->url($i) }}">{{ $i }}</a>

                                                        </li>
                                                    @endif

                                                    @if ($i == $data['products']->lastPage() - 1 && $i < $data['products']->currentPage() + 2)
                                                        <li><a href="#">&hellip;</a></li>
                                                    @elseif ($i == $data['products']->currentPage() + 2 && $i < $data['products']->lastPage())
                                                        <li><a href="#">&hellip;</a></li>
                                                    @endif
                                                @endfor
                                            @endif

                                        </ul>

                                    </div>

                                    <div class="next">

                                        @if ($data['products']->hasMorePages())
                                            <a href="{{ $data['products']->nextPageUrl() }}">Next<i
                                                    class="fa fa-arrow-right"></i></a>
                                        @else
                                            <span class="disabled">Next<i class="fa fa-arrow-right"></i></span>
                                        @endif

                                    </div>

                                </div>

                            </div>

                            <div id="sidebar" class="col-md-3">

                                <div class="sidebar-content">

                                    <div class="head-side-bar">

                                        <h4>Refine Your Search</h4>

                                    </div>

                                    <form method="GET" action="" class="search-form">

                                        <div class="">

                                            <input class="form-control" placeholder="Search" name="search"
                                                style="margin-bottom: 10px" type="text">

                                        </div>


                                        <div class="">

                                            <button class="btn btn-warning" type="submit">Search Now<i
                                                    class=" mx-2 fa fa-search"></i></button>

                                        </div>

                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                </section>

            </div>

        </div>

        @include('Frontend.layouts.footer')

        @include('Frontend.layouts.mobile-nav')

    </div>

    @if (Session::has('success'))
        <script>
            alertify.success("{{ Session::get('success') }}");
        </script>
    @endif

@endsection
