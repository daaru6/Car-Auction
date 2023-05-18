@include('user.header', ['title' => $data['title']])

@include('user.menu')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">

                <div class="col-12">

                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <h4 class="mb-sm-0 font-size-18">Listing:</h4>

                        <div class="page-title-right">

                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>

                                <li class="breadcrumb-item active">All Cars</li>

                            </ol>

                        </div>

                    </div>

                </div>

            </div>
            <!-- end page title -->

            @if (Session::has('reject'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                    {{ Session::get('reject') }}</p>
            @endif
            @if (Session::has('success'))
                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                    {{ Session::get('success') }}</p>
            @endif

            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <div class="card-body">

                            @if (Session::has('delete'))
                                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                                    {{ Session::get('delete') }}</p>
                            @endif

                            <table id="datatable" class="table table-bordered dt-responsive   ">

                                <thead>

                                    <tr>

                                        <th>Name</th>
                                        <th>Category</th>
                                        <th>Brand</th>
                                        <th>Starting Price</th>
                                        <th>Winning Price</th>
                                        <th>Transmition</th>
                                        <th>Action</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse ($data['user_cars'] as $car)
                                        <tr>

                                            <td>{{ $car->car_name }}</td>
                                            <td>{{ $car->category->category_name }}</td>
                                            <td>{{ $car->brand->brand_name }}</td>
                                            <td>Rs {{ $car->price }}</td>
                                            <td>Rs {{ $car->bids->where('is_winner', true)->first()->bid_amount }}</td>
                                            <td>
                                                @if ($car->car_type === 1)
                                                    <span class="bg-success text-white p-2 rounded">Automatic</span>
                                                @else
                                                    <span class="bg-success text-white p-2 rounded">Manual</span>
                                                @endif
                                            </td>


                                            <td>
                                                @php
                                                    $winnerBid = $car->bids->where('is_winner', true)->first();
                                                @endphp
                                                @if ($winnerBid && $winnerBid->is_paid == 1)
                                                    <a href="{{ route('user.vieworder', ['slug' => $car->slug, 'id' => $car->car_id]) }}"
                                                        class="btn btn-info btn-md">View Order</a>
                                                @else
                                                    <a href="{{ route('user.payment', ['slug' => $car->slug, 'id' => $car->car_id]) }}"
                                                        class="btn btn-info btn-md">Buy Now</a>

                                                    <a href="{{ route('user.car.reject', ['id' => $car->car_id]) }}"class="reject btn btn-danger waves-effect waves-light btn-md"
                                                        data-bs-toggle="modal" data-bs-target="#staticBackdrop2">Reject
                                                        Car</a>
                                                @endif


                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td>No won cars</td>

                                        </tr>
                                    @endforelse


                                </tbody>

                            </table>

                        </div>

                    </div>

                </div> <!-- end col -->

            </div> <!-- end row -->

            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

</div>
@include('user.footer')
