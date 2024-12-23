@extends('frontend.layouts.app')
@section('title', 'login')
@section('content')

    <section class="gry-bg py-5">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 mx-auto">
                        <div class="card">
                            <div class="text-center px-35 pt-5">
                                <h1 class="heading heading-4 strong-500">
                                    Login to your account.
                                </h1>
                            </div>

                            <div class="px-5 py-3 py-lg-4">
                                <div class="">
                                    <form id="usephone" class="form-default" role="form" method="POST"
                                        action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group phone-form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="text"
                                                    class="form-control @error('login') is-invalid @enderror"
                                                    aria-describedby="login" placeholder="Enter Phone or Email"
                                                    name="login" autocomplete="off">
                                                <span class="input-group-addon">
                                                    <i class="text-md la la-phone"></i>
                                                </span>
                                            </div>
                                            @error('login')
                                                <div id="login" class="text-danger tex-xs">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="input-group input-group--style-1">
                                            <input type="password"
                                                class="form-control   @error('password') is-invalid @enderror "
                                                aria-describedby="password" placeholder="Password" name="password"
                                                id="password" autocomplete="current-password">
                                            <span class="input-group-addon">
                                                <i class="text-md la la-lock"></i>
                                            </span>
                                            @error('password')
                                                <div id="password" class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>


                                        <div class="row" style="margin-top: 10px">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <div class="checkbox pad-btm text-left">
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
                                                <a href="/password/reset" class="link link-xs link--style-3">Forgot
                                                    password?</a>
                                            </div>
                                        </div>


                                        <div class="text-center">
                                            <button type="submit"
                                                class="btn btn-styled btn-base-1 btn-md w-100">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="text-center px-35 pb-3">
                                <p class="text-md">
                                    Need an account? <a href="{{ route('register') }}" class="strong-600">Register Now</a>
                                </p>
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
