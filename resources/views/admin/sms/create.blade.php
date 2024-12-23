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
            <form class="row g-3" action="{{URL::to('/admin/sms/store')}}" method="POST">
                @csrf
              <div class="col-md-12">
                <div class="form-floating">
                  <textarea  name="message" class="form-control" placeholder="Leave a comment here" id="floatingTextarea2" style="height: 100px"></textarea>
                  <label for="floatingTextarea2">Write SMS</label>
                </div>
                @error('message') 
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
            </div>
              <div class="btn-group mt-2">
                <button type="button" id="save" class="btn btn-primary">Submit</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form><!-- Vertical Form -->

          </div>
        </div>


      </div>

  </section>

  </div>
@endsection