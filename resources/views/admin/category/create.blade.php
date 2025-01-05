@extends('admin.layouts.app')

@section('content')
<div class="pagetitle">
  <h1>{{$title[0]}}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{url('/admin/'.$title[1])}}">{{$title[0]}}</a></li>
      <li class="breadcrumb-item active">Create</li>
    </ol>
  </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="col-lg-6 offset-lg-3">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Create a {{$title[0]}}</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="{{URL::to('/admin/'.$title[1])}}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="col-12">
                <label for="inputNanme4" class="form-label">Title</label>
                <input type="text" name="category_name" class="form-control" id="inputNanme4">
                @error('category_name') 
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              {{-- <div class="col-12">
                <label for="parent_id" class="form-label"> Parent Category</label>
                <select id="parent_id" class="form-select" name="parent_id">
                  <option selected disabled>Choose...</option>
                  @foreach ($categories as $item)
                      <option value="{{ $item->id }} ">{{ $item->category_name }} </option>
                  @endforeach
                </select>
                @error('parent_id') 
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div> --}}
              <div class="col-12">
                <label for="inputNumber"  class="form-label">File Upload</label>
                  <input class="form-control" name="thumbnail" type="file" id="formFile">
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
                      
                  <option value="1">Active</option>
                  <option value="0">Deactive</option>
                </select>
              </div>
              <div class="btn-group mt-2">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form><!-- Vertical Form -->

          </div>
        </div>


      </div>

  </section>

  </div>
@endsection