@extends('frontend.layouts.app')
@section('title', 'Register')
@section('content')

    <section class="gry-bg py-5">
        <div class="profile">
            <div class="container">
                <div class="row">
                    <div class="col-xxl-4 col-xl-5 col-lg-6 col-md-8 mx-auto">
                        <div class="card">
                            <div class="text-center px-35 pt-5">
                                <h1 class="heading heading-4 strong-500">
                                    Create an account.
                                </h1>
                            </div>
                            <div class="px-5 py-3 py-lg-4">
                                <div class="">
                                    <form class="form-default" role="form" action="{{ route('register') }}"
                                        method="POST">
                                        @csrf
                                        <div class="form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="text" class="form-control" placeholder="Name" name="name"
                                                    @error('name') is-invalid @enderror>
                                                <span class="input-group-addon">
                                                    <i class="text-md la la-user"></i>
                                                </span>
                                                @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group email-form-group" style="display: none;">
                                            <div class="input-group input-group--style-1">
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    placeholder="Email" name="email"  autocomplete="email"
                                                    autofocus>
                                                <span class="input-group-addon">
                                                    <i class="text-md la la-envelope"></i>
                                                </span>
                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="form-group phone-form-group">
                                            <div class="input-group input-group--style-1">
                                                <input type="tel"
                                                    class="form-control  @error('phone') is-invalid @enderror"
                                                    placeholder="e.g. 01700000000" name="phone" autocomplete="off">
                                                <span class="input-group-addon">
                                                    <i class="text-md la la-phone"></i>
                                                </span>
                                            </div>
                                            @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-link p-0" type="button"
                                                onclick="toggleEmailPhone(this)">Use Email Instead</button>
                                        </div>

                                        <div class="form-group">
                                            <!-- <label>password</label> -->
                                            <div class="input-group input-group--style-1">
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    placeholder="Password" name="password">
                                                <span class="input-group-addon">
                                                    <i class="text-md la la-lock"></i>
                                                </span>
                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <!-- <label>confirm_password</label> -->
                                            <div class="input-group input-group--style-1">
                                                <input type="password"
                                                    class="form-control @error('password_confirmation') is-invalid @enderror"
                                                    placeholder="Confirm Password" name="password_confirmation">
                                                <span class="input-group-addon">
                                                    <i class="text-md la la-lock"></i>
                                                </span>
                                                @error('password_confirmation')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="checkbox pad-btm text-left">
                                            <input class="magic-checkbox" type="checkbox" name="checkbox_example_1"
                                                id="checkboxExample_1a" required="">
                                            <label for="checkboxExample_1a" class="text-sm">By signing up you agree to our
                                                terms and conditions.</label>
                                        </div>

                                        <div class="text-right mt-3">
                                            <button type="submit" class="btn btn-styled btn-base-1 w-100 btn-md">Create
                                                Account</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="text-center px-35 pb-3">
                                <p class="text-md">
                                    Already have an account?<a href="{{ route('login') }}" class="strong-600">Log In</a>
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
