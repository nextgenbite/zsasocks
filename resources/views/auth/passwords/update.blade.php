@extends('admin.layouts.app')

@section('content')
<section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-6 d-flex flex-column align-items-center justify-content-center">



          <div class="card mb-3">

            <div class="card-body">

              <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Update Password</h5>
              </div>
                <form  method="POST" action="{{ route('change.update') }}" class="row g-3 needs-validation" novalidate>
                  @csrf


                <div class="col-12">
                  <label for="oldpassword" class="form-label">Current Password</label>
                  <input type="password"  id="oldpassword" required class="form-control" name="oldpassword" required autocomplete="oldpassword">
                  @error('oldpassword') 
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-12">
                  <label for="password" class="form-label">New Password</label>
                  <input type="password" name="password"  id="password" required class="form-control" name="password" required autocomplete="password">
                  @error('password') 
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>
                <div class="col-12">
                  <label for="password_confirmation" class="form-label">Confirm Password</label>
                  <input type="password" name="password_confirmation"  id="password_confirmation" required class="form-control" name="password" required autocomplete="password_confirmation">
                  @error('password_confirmation') 
                  <span class="text-danger">{{ $message }}</span>
                  @enderror
                </div>

                <div class="col-12">
                  <button class="btn btn-primary rounded-pill w-100" type="submit"> {{ __('Update') }}</button>
                </div>
                <div class="col-12">
                    
                    <p class="float-end"> <a href="{{ URL::previous() }}">Back</a></p>
                   
                </div>
              </form>

            </div>
          </div>


        </div>
      </div>
    </div>

  </section>

@endsection
