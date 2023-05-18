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

                <section class="listing-grid">

                    <div class="container">

                        <div class="row">

                            <div id="listing-cars" class="col-md-9">

                                <div id="featured-cars">

                                    <div class="row">

                                        @forelse ($data['cars'] as $car)
                                            <div class="featured-item col-md-4">

                                                <img class="img-fluid img-size" src="{{ asset('upload/' . $car->image) }}"
                                                    alt="">

                                                <div class="down-content">

                                                    <a
                                                        href="{{ route('listing.detail.front', ['slug' => $car->slug, 'car_id' => $car->car_id]) }}">
                                                        <h2>{{ $car->car_name }}</h2>
                                                    </a>
                                                    @if ($car->is_sold == 1)
                                                        <span>Sold</span>
                                                    @else
                                                        <span>Rs : {{ $car->price }}</span>
                                                    @endif

                                                    <div class="light-line"></div>

                                                    <p>Donec eu nullas sapien pretium volutpat vel quis turpis.</p>

                                                    <div class="car-info">

                                                        <ul>

                                                            <li>
                                                                <i class="icon-car"></i>
                                                                {{ $car->car_type === 0 ? 'Manual' : 'Automatic' }}
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

                                        @if ($data['cars']->onFirstPage())
                                            <span class="disabled"><i class="fa fa-arrow-left"></i>Prev</span>
                                        @else
                                            <a href="{{ $data['cars']->previousPageUrl() }}"><i
                                                    class="fa fa-arrow-left"></i>Prev</a>
                                        @endif

                                    </div>

                                    <div class="page-numbers">

                                        <ul>

                                            @if ($data['cars']->lastPage() > 1)
                                                @for ($i = 1; $i <= $data['cars']->lastPage(); $i++)
                                                    @if ($i == $data['cars']->currentPage())
                                                        <li class="active"><a href="#">{{ $i }}</a></li>
                                                    @else
                                                        <li>

                                                            <a href="{{ $data['cars']->url($i) }}">{{ $i }}</a>

                                                        </li>
                                                    @endif

                                                    @if ($i == $data['cars']->lastPage() - 1 && $i < $data['cars']->currentPage() + 2)
                                                        <li><a href="#">&hellip;</a></li>
                                                    @elseif ($i == $data['cars']->currentPage() + 2 && $i < $data['cars']->lastPage())
                                                        <li><a href="#">&hellip;</a></li>
                                                    @endif
                                                @endfor
                                            @endif

                                        </ul>

                                    </div>

                                    <div class="next">

                                        @if ($data['cars']->hasMorePages())
                                            <a href="{{ $data['cars']->nextPageUrl() }}">Next<i
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

                                            <input  class="form-control" placeholder="Search" name="search" style="margin-bottom: 10px" type="text"  >

                                        </div>

                                        <div class="select">

                                            <select name="category_name" id="make">

                                                <option value="" hidden disabled selected>Select Category

                                                </option>

                                                @forelse ($data['all_category'] as $category)
                                                    <option value="{{ $category->slug }}">

                                                        {{ $category->category_name }}

                                                    </option>

                                                @empty

                                                    <option value="">No Category Available</option>
                                                @endforelse

                                            </select>

                                        </div>

                                        <div class="select">

                                            <select name="brand_name" id="model">

                                                <option value="" hidden disabled selected>Select Brand

                                                </option>

                                                @forelse ($data['all_brands'] as $brand)
                                                    <option value="{{ $brand->slug }}">

                                                        {{ $brand->brand_name }}

                                                    </option>

                                                @empty

                                                    <option value="">No Brand Available</option>
                                                @endforelse>

                                            </select>

                                        </div>

                                        <div class="select">

                                            <select name="car_type" id="types">

                                                <option hidden disabled selected>Select Car Types</option>

                                                <option value="automatic">Automatic</option>

                                                <option value="manual">Manual</option>

                                            </select>

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

@endsection
