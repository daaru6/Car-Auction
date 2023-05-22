@include('admin.header', ['title' => $title])

<!-- DataTables -->
<link href="{{ asset('assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />


<!-- Responsive datatable examples -->
<link href="{{ asset('assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

<style>

    .success {

        background-color: #ddffdd;

        border-left: 6px solid #04AA6D;

        padding: 3px;

    }

    .warning {

        background-color: #ffffcc;

        border-left: 6px solid #ffeb3b;

        padding: 3px;

    }

    .btn {

        font-size: 10px !important;
        
    }
</style>

@include('admin.menu')

<div class="main-content">

    <div class="page-content">

        <div class="container-fluid">

            <!-- start page title -->

            <div class="row">

                <div class="col-12">

                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <h4 class="mb-sm-0 font-size-18">Orders:</h4>

                        <div class="page-title-right">

                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>

                                <li class="breadcrumb-item active">Order</li>

                            </ol>

                        </div>

                    </div>

                </div>

            </div>
            <!-- end page title -->

            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <div class="card-header container-fluid">

                        </div>

                        <div class="card-body">

                            @if (Session::has('success'))

                                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">

                                    {{ Session::get('success') }}
                                </p>

                            @endif

                            <table id="datatable" class="table table-bordered dt-responsive  nowrap w-100">

                                <thead>

                                    <tr>

                                        <th>Order ID</th>

                                        <th>Email</th>

                                        <th>Total Amount</th>

                                        <th>Items</th>

                                        <th>Status</th>

                                        <th>Order placed</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse ($orders as $order)

                                        <tr>

                                            <td>{{ "BK-" . date("Ymd", strtotime($order->created_at)) . "-" . str_pad($order->id, 6, "0", STR_PAD_LEFT) }}</td>

                                            <td>{{ !empty($order->user->email) ? $order->user->email : $order->email }}</td>

                                            <td>{{ $order->total_amount }}</td>

                                            <td>{{ count($order->orderItems) }}</td>
                                            
                                            <td><a href="{{ route('admin.order.status', ['id'=>$order->id ,'status' =>$order->status]) }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop4" data-status="{{ $order->status }}" class="update-status btn {{ $order->status == "Pending" ? 'btn-secondary' : 'btn-success' }}">{{ $order->status == 'Pending' ? 'Pending' : 'Completed' }}</a></td>

                                            <td>{{ $order->created_at->diffForHumans() }}</td>

                                            <td>
                                                <a href="{{ route('admin.order.detail', ['id'=>$order->id]) }}" class="btn btn-info btn-md">View Order</a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td colspan="4">No User Found</td>

                                        </tr>

                                    @endforelse


                                </tbody>

                            </table>

                        </div>

                    </div>

                </div> <!-- end col -->

            </div> <!-- end row -->

        </div> <!-- container-fluid -->

    </div>






</div>
@include('admin.footer')
