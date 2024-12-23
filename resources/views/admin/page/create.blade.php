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
    <div class="col-lg-10 offset-lg-1">

        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Create a {{$title[0]}}</h5>

            <!-- Vertical Form -->
            <form class="row g-3" action="{{URL::to('/admin/'.$title[1])}}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="col-12">
                <label for="inputNanme4" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="inputNanme4">
                @error('title') 
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-12">
                <div class="mb-3">
                  <label for="inputNanme4" class="form-label">About</label>
                  <textarea  name="content" class="" rows="5" id="summernote"></textarea>
                  
                  @error('content') 
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>
            </div>
              <div class="col-12">
                <label for="inputState" class="form-label">Status</label>
                <select id="inputState" class="form-select" name="status">
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