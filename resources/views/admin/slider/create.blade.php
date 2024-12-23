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
    <div class="row">
       
      <div class="col-8 col-lg-8 offset-2 grid-margin">
        <div class="card">
            <div class="card-body align-center">
       
              <form method="POST" action="{{URL::to('/admin/slider')}}" enctype="multipart/form-data" class="forms-sample">
                @csrf
                <div class="col-12">
                  <label for="inputNumber"  class="form-label">File Upload</label>
                    <div class="input-group">
  
                      <input class="form-control" name="slider_image" onchange="loadFile(event)" type="file" id="formFile">
                      <img style="width: 2rem" id="output"  src="{{asset('/placeholder.jpg')}}" alt="">
                  </div>
                    {{-- <small class="text-info">Upload size must be Width: 200 and Height: 200 </small> --}}
                    <br>
                    @error('thumbnail')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1"> Url</label>
                    <input type="url" class="form-control p-input" name="url" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Url">

                </div>

                <div class="col-12">
                  <label for="inputState" class="form-label">Status</label>
                  <select id="inputState" class="form-select" name="slider_status">
                    <option selected disabled>Choose...</option>
                        
                    <option value="1">Active</option>
                    <option value="0">Deactive</option>
                  </select>
                </div>
                <div class="btn-group mt-2">
                  <button type="submit" class="btn btn-primary">Submit</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
                </form>
            </div>
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