@extends('frontend.layouts.app')
@section('title', 'login')
@section('content')

    <section class="gry-bg py-5">
        <div class="profile">
            <div class="container" style="margin-top: 80px">
                <div class="row">
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 mx-auto">
                        <div class="card shadow-lg border">
                            <div class="text-center px-35 pt-5 " >
                                <h3 class="heading heading-4 strong-500">
                                    Login to your account.
                                </h3>
                            </div>

                            <div class="px-5 py-3 py-lg-4">
                                <div class="">
                                    <form id="usephone" class="form-default" role="form" method="POST"
                                        action="{{ route('login') }}">
                                        @csrf

                            
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon2"> <i class="text-md bi bi-phone"></i></span>
                                            <input type="text" class="form-control  @error('password') is-invalid @enderror" aria-describedby="login" placeholder="Enter Phone or Email"
                                            name="login" autocomplete="off">
                                            @error('login')
                                            <div id="login" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                          </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon2"> <i class="text-md bi bi-lock"></i></span>
                                            <input type="text" class="form-control  @error('password') is-invalid @enderror" placeholder="Password" aria-describedby="password" placeholder="Password" name="password"
                                            id="password" autocomplete="current-password">
                                            @error('password')
                                            <div id="password" class="invalid-feedback">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                          </div>
                              


                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="checkbox pad-btm text-end">
                                                        <input id="demo-form-checkbox" class="magic-checkbox"
                                                            type="checkbox" name="remember" id="remember"
                                                            {{ old('remember') ? 'checked' : '' }}>
                                                        <label for="demo-form-checkbox" class="text-sm">
                                                            Remember Me
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 text-right">
                                                <a href="/password/reset" class="link">Forgot
                                                    password?</a>
                                            </div>
                                        </div>


                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-primary shadow-lg  btn-md w-100">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
@push('scripts')
    <script>
        var isPhoneShown = true;

        function toggleEmailPhone(el) {
            if (isPhoneShown) {
                $('.phone-form-group').hide();
                $('.email-form-group').show();
                isPhoneShown = false;
                $(el).html('Use Phone Instead');
            } else {
                $('.phone-form-group').show();
                $('.email-form-group').hide();
                isPhoneShown = true;
                $(el).html('Use Email Instead');
            }
        }
    </script>
@endpush
