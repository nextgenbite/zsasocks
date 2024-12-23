@extends('frontend.layouts.app')
@section('title', auth()->user()->name)
@section('content')
    <section class="gry-bg py-4 profile">
        <div class="container">
            <div class="row cols-xs-space cols-sm-space cols-md-space">
                <div class="col-lg-3 d-none d-lg-block">
                    @include('frontend.inc.user_sidebar')
                </div>
                <div class="col-lg-9">
                    <!-- Page title -->
                    <div class="page-title">
                        <div class="row align-items-center">
                            <div class="col-md-6 col-12">
                                <h2 class="heading heading-6 text-capitalize strong-600 mb-0">
                                    Dashboard
                                </h2>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="float-md-right">
                                    <ul class="breadcrumb">
                                        <li><a href="">Home</a></li>
                                        <li class="active"><a href="/dashboard">Dashboard</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- dashboard content -->
                    <form class="needs-validation" novalidate action="{{url('/update-profile')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-box bg-white mt-4">
                            <div class="form-box-title px-3 py-2">
                                Basic info
                            </div>
                            <div class="form-box-content p-3">
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Your Name</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="text" class="form-control mb-3" placeholder="Your Name"
                                            name="name" value="{{ $data->name }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Your Email</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="email" class="form-control mb-3" placeholder="Your Email"
                                            name="email" value="{{ $data->email }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Your Phone</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="tel" class="form-control mb-3" placeholder="Your Phone"
                                            name="phone" value="{{ $data->phone }}">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Avatar</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="file" name="avatar" id="file-3"
                                            class="custom-input-file custom-input-file--4"
                                           accept="image/*">
                                        <label for="file-3" class="mw-100 mb-3">
                                            <span></span>
                                            <strong>
                                                <i class="fa fa-upload"></i>
                                                Choose image
                                            </strong>
                                        </label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Your Password</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control mb-3  @error('password') is-invalid @enderror" placeholder="New Password"
                                            name="password">

                                            @error('password')
                                            <div id="validationServer05Feedback" class="invalid-feedback">
                                                {{ $message }}
                                              </div>
                                        @enderror
                                    </div>
                                </div>
                             
                                <div class="row">
                                    <div class="col-md-2">
                                        <label>Confirm Password</label>
                                    </div>
                                    <div class="col-md-10">
                                        <input type="password" class="form-control mb-3  @error('password_confirmation') is-invalid @enderror " placeholder="Confirm Password"
                                            name="password_confirmation">
                                            @error('password_confirmation')
                                            <div id="validationServer05Feedback" class="invalid-feedback">
                                                {{ $message }}
                                              </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-box">
                                <div class="form-box-title px-3 py-2">
                                    Address
                                </div>
                                <textarea type="text" class="form-control mb-3" rows="3" placeholder="Your Address"
                                name="address">{{ $data->address }}</textarea>
                            </div>
                        </div>

                        <div class="text-right mt-4">
                            <button type="submit" class="btn btn-styled btn-base-1">Update Profile</button>
                        </div>

                    </form>
   
                </div>
            </div>
        </div>
    </section>
@endsection
