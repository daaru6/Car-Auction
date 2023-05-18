@include('user.header', ['title' => $data['title']])

@include('user.menu')

<div class="main-content">

    <div class="page-content">

        <div class="container-fluid">

            <div class="row">

                <div class="col-12">

                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">

                        <h4 class="mb-sm-0 font-size-18">Car:</h4>

                        <div class="page-title-right">

                            <ol class="breadcrumb m-0">

                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>

                                <li class="breadcrumb-item active">Cars</li>

                            </ol>

                        </div>

                    </div>

                </div>

            </div>

            <div class="row">

                <div class="col-12">

                    <div class="card">

                        <div class="card-header">

                            <h4 class="card-title">Add New Car</h4>

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

                            <form action="{{ route('user.car.create') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-lg-6 mb-3">

                                        <label for="name" class="form-label">Name</label>

                                        <input class="form-control" type="text" placeholder="Enter Your Car name"
                                            value="{{ old('car_name') }}" name="car_name">

                                    </div>
                                    <div class="col-lg-6 mb-3">

                                        <label for="basicpill-publish-date-id-input" class="form-label">Price</label>
                                        <div class="input-group">
                                            <div class="input-group-text">Rs</div>
                                            <input type="number" value="{{ old('price') }}" name="price"
                                                class="form-control" id="specificSizeInputGroupUsername"
                                                placeholder="Price">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">

                                        <label for="basicpill-category-id-input" class="form-label">Category</label>
                                        <select name="category_id" class="form-control" id="basicpill-category-id-input"
                                            required>
                                            <option value="" hidden disabled selected>Select Category
                                            </option>
                                            @forelse ($data['all_category'] as $category)
                                                <option value="{{ $category->category_id }}">
                                                    {{ $category->category_name }}
                                                </option>
                                            @empty
                                                <option value="">No Category Available</option>
                                            @endforelse

                                        </select>

                                    </div>
                                    <div class="col-lg-4 mb-3">

                                        <label for="basicpill-category-id-input" class="form-label">Brand</label>
                                        <select name="brand_id" class="form-control" id="basicpill-category-id-input"
                                            required>
                                            <option value="" hidden disabled selected>Select Brand
                                            </option>
                                            @forelse ($data['all_brands'] as $brand)
                                                <option value="{{ $brand->brand_id }}">
                                                    {{ $brand->brand_name }}
                                                </option>
                                            @empty
                                                <option value="">No Brand Available</option>
                                            @endforelse

                                        </select>

                                    </div>

                                    <div class="col-lg-4 mb-3">

                                        <label for="basicpill-category-id-input" class="form-label">Car type</label>
                                        <select name="car_type" class="form-control" id="basicpill-category-id-input"
                                            required>
                                            <option value="" hidden disabled selected>Select Type
                                            </option>
                                            <option value="0">Manual</option>
                                            <option value="1">Automatic</option>


                                        </select>

                                    </div>
                                    <div class="col-lg-4 mb-3">

                                        <label for="basicpill-category-id-input" class="form-label">Bid Expiry Date</label>
                                        <input class="form-control" type="date" name="expiry_date"  id="example-date-input">
                               
                                    </div>
                                    <div class="col-lg-12 mb-3">

                                        <label for="basicpill-category-id-input" class="form-label">Description</label>
                                        <textarea class="form-control" name="description" cols="30" rows="5"></textarea>

                                    </div>
                                    
                                    <div class="col-lg-4 mb-3">

                                        <label for="basicpill-category-id-input" class="form-label">Image</label>
                                        <input class="form-control" type="file" id="input-image" accept="image/*"
                                            placeholder="Enter Your Car name" value="{{ old('car_name') }}"
                                            name="image">

                                    </div>
                                    <div id="preview" class="col-lg-8 mb-3">

                                    </div>


                                    <div class="col-lg-4 mb-3">

                                        <label for="basicpill-category-id-input" class="form-label">Gallery
                                            Images</label>
                                        <input class="form-control" type="file" id="input-images" multiple="multiple"
                                            accept="image/*" placeholder="Enter Your Car name"
                                            value="{{ old('car_name') }}" name="additional_images[]">

                                    </div>
                                    <div id="previewMulti" class="col-lg-12 mb-3 row">

                                    </div>

                                    <div class="mt-4">

                                        <button type="submit" class="btn btn-primary w-md">Submit</button>

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

<script>
    $(document).ready(function() {
        // Listen for changes to the input file field
        $('#input-image').on('change', function() {
            // Get the selected file
            var file = this.files[0];
            // Create a new FileReader instance
            var reader = new FileReader();
            // Set the callback function for when the file is loaded
            reader.onload = function(e) {
                // Get the image data URL
                var dataURL = e.target.result;
                // Create a new image element
                var img = $('<img width="200px" >').attr('src', dataURL);
                // Create a new remove button element
                var removeBtn = $('<button class="btn btn-danger btn-xs m-3" >').text('X').click(
                    function() {
                        img.remove();
                        removeBtn.remove();
                        $('#input-image').val('');
                    });
                // Append the image and remove button to the preview div
                $('#preview').html('').append(img).append(removeBtn);
            };
            // Read the selected file as a data URL
            reader.readAsDataURL(file);
        });

        // Keep track of selected files
        var selectedFiles = [];

        $('#input-images').on('change', function() {
            // Get the selected files
            var files = this.files;
            // Loop through each file
            for (var i = 0; i < files.length; i++) {
                // Add the file to the selected files array
                selectedFiles.push(files[i]);
                // Create a new FileReader instance
                var reader = new FileReader();
                // Set the callback function for when the file is loaded
                reader.onload = function(e) {
                    // Get the image data URL
                    var dataURL = e.target.result;
                    // Create a new image element
                    var img = $('<img width="200px" >').attr('src', dataURL);
                    // Create a new remove button element
                    var removeBtn = $('<button class="btn btn-danger btn-xs m-3" >').text('X')
                        .click(function() {
                            // Remove the image from the preview
                            img.remove();
                            removeBtn.remove();
                            // Remove the file from the selected files array
                            var index = selectedFiles.indexOf(file);
                            if (index !== -1) {
                                selectedFiles.splice(index, 1);
                            }
                            // Update the file input tag
                            $('#input-images').val('');
                            for (var i = 0; i < selectedFiles.length; i++) {
                                $('#input-images').append($('<option>').attr('value', i).text(
                                    selectedFiles[i].name));
                            }
                        });
                    // Append the image and remove button to the preview div
                    $('#previewMulti').append($('<div>').addClass('preview-item col-md-3 m-1')
                        .append(img).append(removeBtn));
                };
                // Read the selected file as a data URL
                reader.readAsDataURL(files[i]);
            }
        });

        // Listen for clicks on remove buttons
        $(document).on('click', '.preview-item button', function() {
            var img = $(this).siblings('img');
            var file = selectedFiles[$(this).parent().index()];
            // Remove the image from the preview
            $(this).parent().remove();
            // Remove the file from the selected files array
            var index = selectedFiles.indexOf(file);
            if (index !== -1) {
                selectedFiles.splice(index, 1);
            }
            // Update the file input tag
            $('#input-images').val('');
            for (var i = 0; i < selectedFiles.length; i++) {
                $('#input-images').append($('<option>').attr('value', i).text(selectedFiles[i].name));
            }
        });
    });
</script>
@include('user.footer')
