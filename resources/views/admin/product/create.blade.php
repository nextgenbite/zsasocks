@extends('admin.layouts.app')
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.css"
        integrity="sha512-uKwYJOyykD83YchxJbUxxbn8UcKAQBu+1hcLDRKZ9VtWfpMb1iYfJ74/UIjXQXWASwSzulZEC1SFGj+cslZh7Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    <div class="pagetitle">
        <h1>{{ $title[0] }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/admin/' . $title[1]) }}">{{ $title[0] }}</a></li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">

        <div class="row">

            <div class="col-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ URL::to('/admin/product') }}" enctype="multipart/form-data"
                            class="forms-sample">
                            @csrf
                            <div class="row mt-2">
                                <div class="col-md-4 mb-2">
                                    @include('component.select_input',['name'=>'category_id','placeholder'=>'Select Category' , 'label'=>'Category', 'options'=>$categories, 'option_label'=>'category_name', 'key'=>'id'])

                                </div>

                                <div class="col-md-4 mb-2">
                                    @include('component.text_input',['name'=>'product_name','type'=>'text','placeholder'=>'Enter Product Name' , 'label'=>'Product Name'])
                             
                                </div>
                                <div class="col-md-4 mb-2">
                                    @include('component.text_input',['name'=>'buying_price','type'=>'number','placeholder'=>'Enter Buying Price' , 'label'=>'Buying Price'])
                             
                                </div>
                                <div class="col-md-4 mb-2">
                                    @include('component.text_input',['name'=>'selling_price','type'=>'number','placeholder'=>'Enter Selling Price' , 'label'=>' Selling Price'])
                                </div>
                                <div class="col-md-4 mb-2">
                                    @include('component.text_input',['name'=>'discount_price','type'=>'number','placeholder'=>'Enter Discount Price' , 'label'=>' Discount Price'])
                                </div>
                                <div class="col-md-4 mb-2">
                                    @include('component.text_input',['name'=>'product_qty','type'=>'number','placeholder'=>'Enter Product Quantity' , 'label'=>'Product Quantity'])
                                </div>
                                <div class="col-md-4 mb-2">
                                    @include('component.text_input',['name'=>'sku','type'=>'number','placeholder'=>'Enter Product Quantity' , 'label'=>'Product Model'])
                                </div>
                                <div class="col-12 mb-2">
                                    <div class="form-group">
                                        <label for="exampleTextarea">Product Discription</label>
                                        <textarea class="form-control p-input" name="short_descp_en" id="summernote" rows="6"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label>Upload Thumbnail</label>
                                        <div class="d-flex">
                                            <div class="">
                                                <p><input type="file" accept="image/*" name="product_image"
                                                        id="file" onchange="loadFile(event)" style="display: none;">
                                                </p>
                                                <p><label class="btn btn-outline-primary btn-sm" for="file"
                                                        style="cursor: pointer;"><i
                                                            class="bi bi-upload me-2 "></i>Browse</label></p>
                                            </div>
                                            <div class="">
                                                <p><img id="output" width="200" /></p>
                                            </div>
                                        </div>

                                        @error('product_image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                    </div>
                                </div>
                                <div class="col-12 mb-2">
                                    <label for="inputNumber" class="form-label">Multiple Images</label>
                                    <input class="form-control form-control-sm" name="multi_image[]" multiple
                                        type="file" id="formFile">
                                    <small class="text-info">Upload size must be Width: 600 and Height: 600 </small>
                                    <br>
                                    @error('multi_image[]')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <div class="col-12">
                                    <div class="form-group">
                                        <label>Youtube Video</label>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="text"class="form-control" name="video">
                                                <small class="text-info">https://www.youtube.com/watch?v=<strong
                                                        class="text-danger bold">Q4UAFyriRWg</strong> </small>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-md-6 mb-2">
                                    <label>Colors</label>
                                    <input type="text" name="color" id="colors" placeholder="Colors">
                                </div>
                                <div class="col-md-6 mb-2">
                                    <label>Sizes</label>
                                    <input type="text" name="size" id="size" placeholder="Sizes">
                                </div> --}}
                    
                                <div class="col-md-6 mb-2">
                                    <label for="inputState" class="form-label">Status</label>
                                    <select id="inputState" class="form-select" name="status">
                                        <option selected disabled>Choose...</option>

                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="btn-group mt-2">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <button type="reset" class="btn btn-secondary">Reset</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </section>

    <script>
        // auto image upload show
        var loadFile = function(event) {
            var image = document.getElementById('output');
            image.src = URL.createObjectURL(event.target.files[0]);
        };
    </script>
@endsection
@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-tagsinput/1.3.6/jquery.tagsinput.min.js"
        integrity="sha512-wTIaZJCW/mkalkyQnuSiBodnM5SRT8tXJ3LkIUA/3vBJ01vWe5Ene7Fynicupjt4xqxZKXA97VgNBHvIf5WTvg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#colors').tagsInput();
            $('#size').tagsInput();
        });
    </script>
@endpush
