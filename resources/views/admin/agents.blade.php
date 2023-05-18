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

                        <h4 class="mb-sm-0 font-size-18">Users:</h4>

                        <div class="page-title-right">

                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>

                                <li class="breadcrumb-item active">Users</li>

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

                            <h4 class="card-title">

                                <a href="{{ route('admin.agentNew') }}" class="btn btn-primary btn-md float-right">Add New</a>

                            </h4>

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

                                        <th>Name</th>

                                        <th>Email</th>

                                        <th>Active</th>

                                        <th>Action</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse ($agents as $agent)

                                        <tr>

                                            <td>{{ $agent->name }}</td>

                                            <td>{{ $agent->email }}</td>

                                            <td><a href="{{ route('admin.activeuser',['id'=>$agent->id]) }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop3" data-status="{{ $agent->is_active == 1 ? 'Active' : 'In-active' }}" class="makeactive btn {{ $agent->is_active == 1 ? 'btn-success' : 'btn-danger' }}">{{ $agent->is_active == 1 ? 'Active' : 'In-active' }}</a></td>

                                            <td>
                                                <a href="{{ route('admin.agentEdit', $agent->id) }}" class="btn btn-info btn-md">Edit</a>

                                                <a href="{{ route('admin.agentDelete', $agent->id) }}" class="btn btn-danger btn-md">Delete</a>

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
