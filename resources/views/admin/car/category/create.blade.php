@include('admin.header', ['title' => $data['title']])

@include('admin.menu')

<div class="main-content">

    <div class="page-content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <h4 class="mb-sm-0 font-size-18">Category:</h4>

                        <div class="page-title-right">

                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>

                                <li class="breadcrumb-item active">Car Category</li>

                            </ol>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-3">

                    <div class="card">

                        <div class="card-header">

                            <h4 class="card-title">Add New Car Category</h4>

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

                                        <form action="{{ route('admin.car.category.create') }}" method="POST">

                                            @csrf

                                            <div class="mb-3">

                                                <label for="name" class="form-label">Name</label>

                                                <input class="form-control" type="text"
                                                    placeholder="Enter Car category name"
                                                    value="{{ old('category_name') }}" name="category_name">

                                            </div>

                                            <div class="mt-4">

                                                <button type="submit" class="btn btn-primary w-md">Submit</button>

                                            </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div> <!-- end col -->

            </div>
            <!-- end row -->

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


                                        <th>Action</th>

                                    </tr>

                                </thead>


                                <tbody>

                                    @forelse ($data['all_category'] as $category)
                                        <tr>

                                            <td>{{ $category->category_name }}</td>


                                            <td>
                                                <a href="{{ route('admin.car.category.edit', ['id'=> $category->category_id]) }}"
                                                    class="btn btn-info btn-md">Edit</a>

                                                <a href="{{ route('admin.car.category.del', ['id'=> $category->category_id]) }}"class="delete btn btn-danger waves-effect waves-light btn-md"
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">Delete</a>

                                            </td>

                                        </tr>

                                    @empty

                                        <tr>

                                            <td>No Category Found</td>

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
    <!-- End Page-content -->
</div>
@include('admin.footer')
