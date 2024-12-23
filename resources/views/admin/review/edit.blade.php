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
            <form class="row g-3" action="{{URL::to('/admin/'.$title[1], $data->id)}} " method="POST" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <label for="inputNumber"  class="form-label">File Upload</label>
                  <div class="input-group">

                    <input class="form-control" name="path" type="file" id="formFile">
                    <img style="width: 2rem"  src="{{asset($data->path ?: '/placeholder.jpg')}}" alt="">
                </div>
                  
                  <br>
                  @error('path')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
              </div>
              <div class="col-12">
                <label for="inputState" class="form-label">Status</label>
                <select id="inputState" class="form-select" name="status">
                  <option selected disabled>Choose...</option>
                      
                  <option value="1" {{$data->status == 1? 'selected': '' }}>Active</option>
                  <option value="0" {{$data->status == 0? 'selected': '' }}>Deactive</option>

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