@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
      <h1>Point</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active">Point</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="col-8 offset-2">

            <div class="card">
              <div class="card-body">
  <form class="p-2" action="{{Route('setting.store')}}" method="POST">
    @csrf
    <div class="">
      <div class="mb-3  ">
          <label for="point_name" class="form-label">Point Name</label>
          <input type="text" name="key[point_name]" class="form-control"
              value="{{ old('point_name',$settings['point_name'] ?? '' ) }}">

      </div>
  </div>
  <div class="">
      <div class="mb-3 ">
          <label for="point" class="form-label">Per Point</label>
          <input type="number" name="key[point]" class="form-control"
              value="{{ old('point',$settings['point'] ?? '' ) }}">
              <small class="">ex. per 10 point 1TK = 10</small>
      </div>
  </div>
  <button type="submit" class="btn btn-primary btn-sm">Update</button>
  </form>
  <hr>
                <!-- Vertical Form -->
                <form class="p-2" action="{{Route('point.store')}}" method="POST">
                    @csrf
                    <div class="row">
             
                    {{-- <div class="col-12">
                      <label for="inputState" class="form-label">Name</label>
                      <select id="inputState" class="form-select" name="key[name]">
                        <option selected disabled>Choose...</option>
                            
                        <option value="daily_login">Daily Login</option>
                        <option value="registration">Registration</option>
                      </select>
                      @error('name') 
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div> --}}
                      <div class="col-12">
                        <div class="mb-3">
                            <label for="daily_login" class="form-label">Daily Login</label>
                            <input type="number" name="key[daily_login]" class="form-control"
                                value="{{ old('daily_login', $data['daily_login'] ?? '') }}">
                                @error('daily_login') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                      <div class="col-12">
                        <div class="mb-3">
                            <label for="registration" class="form-label">Registration</label>
                            <input type="number" name="key[registration]" class="form-control"
                                value="{{ old('registration', $data['registration'] ?? '') }}">
                                @error('registration') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                      <div class="col-12">
                        <div class="mb-3">
                            <label for="product" class="form-label">Product</label>
                            <input type="number" name="key[product]" class="form-control"
                                value="{{ old('product', $data['product'] ?? '') }}">
                                @error('product') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                
                    </div>
                  <div class="mt-2 btn-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                  </div>
                </form><!-- Vertical Form -->
  
              </div>
            </div>

  
          </div>
    </section>

@endsection