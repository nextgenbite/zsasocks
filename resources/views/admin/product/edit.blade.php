@extends('admin.layouts.app')

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
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ URL::to('/admin/product', $product->id) }}"
                        enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        @method('PATCH')
                        <div class="row g-3">
                            <!-- Category -->
                            <div class="col-md-4">
                                @include('component.select_input', [
                                    'name' => 'category_id',
                                    'placeholder' => 'Select Category',
                                    'label' => 'Category',
                                    'options' => $categories,
                                    'option_label' => 'category_name',
                                    'key' => 'id',
                                    'selected' => $product->category_id
                                ])
                            </div>

                            <!-- Product Name -->
                            <div class="col-md-4">
                                @include('component.text_input', [
                                    'name' => 'product_name',
                                    'type' => 'text',
                                    'placeholder' => 'Enter Product Name',
                                    'label' => 'Product Name',
                                    'value' => $product->product_name
                                ])
                            </div>

                            <!-- Buying Price -->
                            <div class="col-md-4">
                                @include('component.text_input', [
                                    'name' => 'buying_price',
                                    'type' => 'number',
                                    'placeholder' => 'Enter Buying Price',
                                    'label' => 'Buying Price',
                                    'value' => $product->buying_price
                                ])
                            </div>

                            <!-- Selling Price -->
                            <div class="col-md-4">
                                @include('component.text_input', [
                                    'name' => 'selling_price',
                                    'type' => 'number',
                                    'placeholder' => 'Enter Selling Price',
                                    'label' => 'Selling Price',
                                    'value' => $product->selling_price
                                ])
                            </div>

                            <!-- Discount Price -->
                            <div class="col-md-4">
                                @include('component.text_input', [
                                    'name' => 'discount_price',
                                    'type' => 'number',
                                    'placeholder' => 'Enter Discount Price',
                                    'label' => 'Discount Price',
                                    'value' => $product->discount_price
                                ])
                            </div>

                            <!-- Product Quantity -->
                            <div class="col-md-4">
                                @include('component.text_input', [
                                    'name' => 'product_qty',
                                    'type' => 'number',
                                    'placeholder' => 'Enter Product Quantity',
                                    'label' => 'Product Quantity',
                                    'value' => $product->product_qty
                                ])
                            </div>

                            <!-- Product Model -->
                            <div class="col-md-4">
                                @include('component.text_input', [
                                    'name' => 'sku',
                                    'type' => 'text',
                                    'placeholder' => 'Enter Product Model',
                                    'label' => 'Product Model',
                                    'value' => $product->sku
                                ])
                            </div>

                            <!-- Product Description -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="exampleTextarea">Product Description</label>
                                    <textarea class="form-control p-input" name="short_descp_en" id="summernote" rows="4" >
                                        {{ $product->short_descp_en }}
                                    </textarea>
                                </div>
                            </div>

                            <!-- Thumbnail Upload -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Upload Thumbnail</label>
                                    <div class="d-flex justify-content-center flex-column align-content-center gap-1">
                                        <img src="{{ URL::to($product->product_image) }}" id="output" width="200" />
                                        <div>
                                            <input type="file" accept="image/*" name="product_image" id="file" onchange="loadFile(event)" style="display: none;">
                                            <label class="btn btn-outline-primary btn-sm" for="file" style="cursor: pointer;">
                                                <i class="bi bi-upload me-2"></i>Browse
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                @error('product_image')
                                <span class="text-danger">{{ $message }}</span>
                                 @enderror
                            </div>

                            <!-- Multiple Images -->
                            <div class="col-md-6">
                                <label for="inputNumber" class="form-label">Multiple Images</label>
                                <input class="form-control form-control-sm" name="multi_image[]" multiple type="file">
                                <small class="text-info">Upload size must be Width: 600 and Height: 600</small>
                                @error('multi_image[]')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Status</label>
                                <select id="inputState" class="form-select" name="status">
                                    <option  disabled>Choose...</option>
                                    <option value="1" {{ $product->status == '1' ? 'checked' : ''}}>Active</option>
                                    <option value="0" {{ $product->status == '0' ? 'checked' : ''}}>Deactive</option>
                                </select>
                            </div>
                        </div>

                        <!-- Submit and Reset Buttons -->
                        <div class="d-flex justify-content-end mt-3">
                            <button type="reset" class="btn btn-secondary me-2">Reset</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    // Auto image upload preview
    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>
@endsection
