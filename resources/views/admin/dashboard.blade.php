@include('admin.header', ['title' => $title])
<link href="{{ asset('assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet"
    type="text/css" />

@include('admin.menu')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-xl-4 col-md-6">
                    <!-- card -->
                    <div class="card card-h-100">
                        <!-- card body -->
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <span class="text-muted mb-3 lh-1 d-block text-truncate">Users</span>
                                    <h4 class="mb-3">
                                        <span class="counter-value" data-target="{{ $agents }}">0</span>
                                    </h4>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->

                </div><!-- end col -->
                <div class="col-xl-4 col-md-6">
                    <!-- card -->

                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Car Categories</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="{{ $car_categories }}">0</span>
                                        </h4>
                                    </div>


                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->


                    </div><!-- end col -->
                    <div class="col-xl-4 col-md-6">
                        <!-- card -->
                        <div class="card card-h-100">
                            <!-- card body -->
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-6">
                                        <span class="text-muted mb-3 lh-1 d-block text-truncate">Car brands</span>
                                        <h4 class="mb-3">
                                            <span class="counter-value" data-target="{{ $car_brands }}">0</span>
                                        </h4>
                                    </div>


                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->

                    </div><!-- end col -->
                </div><!-- end row-->
                <!-- end row -->
            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

    </div>
    @include('admin.footer')
