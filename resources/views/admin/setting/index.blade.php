@extends('admin.layouts.app')

@section('content')
    <div class="pagetitle">
      <h1>Settings</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a></li>
          <li class="breadcrumb-item active">Setting</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="col-12">

            <div class="card">
              <div class="card-body">
  
                <!-- Vertical Form -->
                <form class="p-2" action="{{Route('setting.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                        <div class="mb-3">
                            <label for="app_name" class="form-label">App Name</label>
                            <input type="text" name="key[app_name]" class="form-control"
                                value="{{ old('app_name', $settings['app_name'] ?? '') }}">
                                @error('app_name') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" name="key[phone]" class="form-control"
                                value="{{ old('phone', $settings['phone'] ?? '') }}">
                                @error('phone') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" name="key[address]" class="form-control"
                                value="{{ old('address', $settings['address'] ?? '') }}">
                                @error('address') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                      <div class="col-md-6">
                        <div class="mb-3">
                            <label for="contact_mail" class="form-label">Contact Mail</label>
                            <input type="email" name="key[contact_mail]" class="form-control"
                                value="{{ old('contact_mail', $settings['contact_mail'] ?? '') }}">
                                @error('contact_mail') 
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                      <label for="example-fileinput" class="form-label">Logo</label>
                      <div class=" input-group mb-3">
                          <input type="file" name="key[logo]" id="logo"
                              class="form-control  @error('logo') is-invalid @enderror">
                          <img id="showImage" src="{{ asset($settings['logo'] ?? 'placeholder.jpg') }}"
                              class="input-group-text img-thumbnail" alt="logo"
                              style="height:2.4rem; padding:-1rem">
                      </div>
                      @error('logo')
                          <span class="text-danger"> {{ $message }} </span>
                      @enderror
                  </div> <!-- end col -->
                    <div class="col-md-6">
                      <label for="example-fileinput" class="form-label">Favicon</label>
                      <div class=" input-group mb-3">
                          <input type="file" name="key[favicon]" id="favicon"
                              class="form-control  @error('favicon') is-invalid @enderror">
                          <img id="showImage" src="{{ asset($settings['favicon'] ?? 'placeholder.jpg') }}"
                              class="input-group-text img-thumbnail" alt="favicon"
                              style="height:2.4rem; padding:-1rem">
                      </div>
                      @error('favicon')
                          <span class="text-danger"> {{ $message }} </span>
                      @enderror
                  </div> <!-- end col -->
                      <div class="col-md-12">
                        <div class="mb-3">
                          <label for="inputNanme4" class="form-label">Description</label>
                          <textarea  name="key[about]" class="" rows="5" id="summernote">{!! $settings['about'] ?? '' !!}
  
                          </textarea>
                          
                          @error('about') 
                              <span class="text-danger">{{ $message }}</span>
                              @enderror
                        </div>
                    </div>
                     
                    <h5 class="text-muted">Theme</h5>
                    <div class="col-md-6">
                        <div class="mb-3  ">
                            <label for="color" class="form-label">Color</label>
                            <input type="color" name="key[color]" class="form-control"
                                value="{{ old('color',$settings['color'] ?? '' ) }}">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 ">
                            <label for="hover_color" class="form-label">Hover Color</label>
                            <input type="color" name="key[hover_color]" class="form-control"
                                value="{{ old('hover_color',$settings['hover_color'] ?? '' ) }}">

                        </div>
                    </div>
                 
                  <div class="text-center mt-2">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                  </div>
                </form><!-- Vertical Form -->
  
              </div>
            </div>

  
          </div>
    </section>

@endsection