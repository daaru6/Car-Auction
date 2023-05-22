@include('admin.header', ['title' => $title])

@include('admin.menu')
<div class="main-content">
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">

                <div class="col-12">

                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <h4 class="mb-sm-0 font-size-18">Order:</h4>

                        <div class="page-title-right">

                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>

                                <li class="breadcrumb-item">Orders</li>
                                <li class="breadcrumb-item active">View Order</li>

                            </ol>

                        </div>

                    </div>

                </div>

            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="invoice-title">
                                <div class="d-flex align-items-start">
                                    <div class="flex-grow-1">
                                        <div class="mb-4">
                                            <a href="{{ route('index.front') }}"><img src="{{ URL::asset('frontassets/images/logo.png') }}"
                                                alt=""></a>
                                        </div>
                                    </div>
                                    <div class="flex-shrink-0">
                                        <div class="mb-4">
                                            <h4 class="float-end font-size-16">Invoice # {{ "BK-" . date("Ymd", strtotime($order->created_at)) . "-" . str_pad($order->id, 6, "0", STR_PAD_LEFT) }}</h4>
                                        </div>
                                    </div>
                                </div>
            
            
                                <p class="mb-1">{{ $order->address }}</p>
                                <p class="mb-1"><i class="mdi mdi-email align-middle mr-1"></i> {{ !empty($order->user->email) ? $order->user->email : $order->email }}</p>
                                <p><i class="mdi  align-middle mr-1"></i> {{ !empty($order->user->name) ? $order->user->name : $order->name }}</p>
                            </div>
                            <hr class="my-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div>
                                        
                                        <h5 class="font-size-14 mb-2">{{ auth()->user()->name }}</h5>
                                        <p class="mb-1">1208 Sherwood Circle
                                            Lafayette, LA 70506</p>
                                        <p class="mb-1">{{ auth()->user()->email }}</p>
                                        <p>337-256-9134</p>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div>
                                        <div>
                                            <h5 class="font-size-15">Order Date:</h5>
                                            <p>{{ date('F j, Y', strtotime($order->created_at)) }}</p>
                                        </div>
                                        
                                        <div class="mt-4">
                                            <h5 class="font-size-15">Payment Method:</h5>
                                            <p class="mb-1">Visa ending **** 4242</p>
                                            <p>{{ !empty($order->user->email) ? $order->user->email : $order->email }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
            
                            <div class="py-2 mt-3">
                                <h5 class="font-size-15">Order summary</h5>
                            </div>
                            <div class="p-4 border rounded">
                                <div class="table-responsive">
                                    <table class="table table-nowrap align-middle mb-0">
                                        <thead>
                                            <tr>
                                                <th style="width: 70px;">No.</th>
                                                <th>Quantity</th>
                                                <th>Item</th>
                                                <th>Price</th>
                                                <th class="text-end" style="width: 120px;">Sub Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @forelse ($order->orderItems as $item)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <th>{{ $item->quantity }}</th>
                                                <td>
                                                    <h5 class="font-size-15 mb-1">{{ $item->product->name }}</h5>
                                                    <p class="font-size-13 text-muted mb-0">{{ $item->product->description }}</p>
                                                </td>
                                                <th>Rs{{ $item->price }}</th>
                                                <td class="text-end">Rs{{ $item->price * $item->quantity }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">No order items found.</td>
                                            </tr>
                                        @endforelse
                                     
            

            
                                   
                             
                                            <tr>
                                                <th scope="row" colspan="4" class="border-0 text-end">Total</th>
                                                <td class="border-0 text-end">
                                                    <h4 class="m-0">Rs{{ $order->total_amount}}</h4>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="d-print-none mt-3">
                                <div class="float-end">
                                    <a href="javascript:window.print()" class="btn btn-success waves-effect waves-light mr-1"><i class="fa fa-print"></i></a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- end row -->
        </div>
        <!-- container-fluid -->
    </div>
    <!-- End Page-content -->

</div>
@include('admin.footer')
