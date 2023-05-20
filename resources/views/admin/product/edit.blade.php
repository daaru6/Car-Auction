@include('admin.header', ['title' => $title])

@include('admin.menu')
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <ol class="breadcrumb m-0">

                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>

                            <li class="breadcrumb-item">Product</li>

                            <li class="breadcrumb-item active">+ Edit</li>

                        </ol>


                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
           
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Edit Product</h4>

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
                                        <form action="{{ route('admin.product.update',['id'=>$product->id]) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Product Name</label>
                                                <input class="form-control" type="text" value="{{ $product->name }}"
                                                    placeholder="Enter Product Name..." id="name" name="name"
                                                    >
                                            </div>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Product Price</label>
                                                <input class="form-control" type="number" value="{{ $product->price }}"
                                                    placeholder="Enter Product Price..." id="name" name="price"
                                                    >
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Description</label>
                                                <textarea class="form-control" type="email" id="email" name="description" >{{ $product->description }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Image</label>
                                                <input class="form-control" type="file" accept="image/*"
                                                    name="image" placeholder="Change password">
                                             
                                            </div>
                                            @isset($product->image)
                                            <img width="100px" height="100px" style="object-fit: contain"
                                            class="img-thumbnail" src="{{ asset('upload/' . $product->image) }}"
                                            alt="">
                                            @endisset  



                                            <div class="mt-4">
                                                <button type="submit" class="btn btn-primary w-md">Update</button>
                                            </div>
                                        </form>
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
