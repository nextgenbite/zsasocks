@extends('admin.layouts.app')

@section('content')
<div class="pagetitle">
  <h1>{{$title[0]}}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{url('/admin/'.$title[1])}}">{{$title[0]}}</a></li>
      <li class="breadcrumb-item active">Update</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="col-lg-6 offset-lg-3">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Update {{$title[0]}}</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="{{URL::to('/admin/'.$title[1], $category->id)}} " method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
              <div class="col-12">
                <label for="inputNanme4" class="form-label">Title</label>
                <input type="text" name="category_name" class="form-control" value="{{$category->category_name}} " id="inputNanme4">
                @error('category_name') 
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>

              <div class="col-12">
                <label for="inputNumber"  class="form-label">File Upload</label>
                  <div class="input-group">

                    <input class="form-control" name="thumbnail" type="file" id="formFile">
                    <img style="width: 2rem"  src="{{asset($category->thumbnail ?: '/placeholder.jpg')}}" alt="">
                </div>
                  <small class="text-info">Upload size must be Width: 200 and Height: 200 </small>
                  <br>
                  @error('thumbnail')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
              </div>
              <div class="col-12">
                <label for="inputState" class="form-label">Status</label>
                <select id="inputState" class="form-select" name="category_status">
                  <option selected disabled>Choose...</option>
                      
                  <option value="1" {{$category->category_status == 1? 'selected': '' }}>Active</option>
                  <option value="0" {{$category->category_status == 0? 'selected': '' }}>Deactive</option>

                </select>
              </div>
              <div class="btn-group mt-2">
                <button type="submit" class="btn btn-primary">Update</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form><!-- Vertical Form -->

          </div>
        </div>


      </div>
 @method('PATCH')
  </section>



@endsection