@include('admin.header', ['title' => $title])

@include('admin.menu')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">



                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-3"></div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Agent</h4>

                        </div>
                        <div class="card-body p-4">
                            @if (Session::has('success'))
                                <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                                    {{ Session::get('success') }}</p>
                            @endif
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <form action="{{ route('admin.agentEdit', $agent->id) }}" method="POST">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input class="form-control" type="text"
                                                    placeholder="Enter First Name" id="name" name="name"
                                                    value="{{ $agent->name }}" required>
                                            </div>


                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input class="form-control" type="email" id="email" name="email"
                                                    value="{{ $agent->email }}" placeholder="Enter Email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input class="form-control" type="password" id="password"
                                                    name="password" placeholder="Change password">
                                            </div>



                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-danger w-md">Submit</button>
                                            </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->








        </div> <!-- container-fluid -->
    </div>
    <!-- End Page-content -->
</div>
@include('admin.footer')
