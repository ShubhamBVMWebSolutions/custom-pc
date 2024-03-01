@extends('front-layout.master_layout')
@section('title','Register')
@section('meta_keywords',metaTagsByKeyPage('sign_up','meta_keywords'))
@section('meta_description',metaTagsByKeyPage('sign_up','meta_description'))
@section('content')

<!-- dashboard Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="cart_title">Register</h2>
                </div>
            </div>

            <div class="ec-register-wrapper">
                    <div class="ec-register-container">
                        <div class="ec-register-form">
                            @if(session()->has('alert-success'))
               <div class="alert alert-success alert-dismissible  mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  <strong>Success!</strong> {{ session()->get('alert-success') }}
               </div>
               @endif

                            <form method="POST" action="{{ route('user.register') }}">
                        @csrf
                        <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="">{{ __('First Name') }} <span>*</span></label>


                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="name" autofocus>

                                @error('first_name')
                                    <p class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="">{{ __('Last Name') }} <span>*</span></label>

                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="name" autofocus>

                                @error('last_name')
                                    <p class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="name" class="">{{ __('Username') }} <span>*</span></label>

                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <p class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group ">
                            <label for="email" class="">{{ __('E-Mail Address') }} <span>*</span></label>


                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <p class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group ">
                                <label for="email" class="">{{ __('Mobile Number') }} <span>*</span></label>


                                <input id="mobile_number"  type="tel" pattern="[0-9]{10}" class="form-control @error('mobile_number') is-invalid @enderror" name="mobile_number" value="{{ old('mobile_number') }}" placeholder="10 digit mobile number" required>
                                @error('mobile_number')
                                    <p class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </p>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="password" class="">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                    @error('password')
                                        <p class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                            <br>
                                            {{-- <small>Password must be at least 6 characters long, contain at least one uppercase letter, one lowercase letter, one digit, and one special character.</small> --}}
                                            <small>Password must meet the following requirements:

                                            <ul>
                                                <li>Password must be at least 6 characters long</li>
                                                <li>Contain at least one uppercase letter</li>
                                                <li>Contain at least one lowercase letter</li>
                                                <li>Contain at least one digit</li>
                                                <li>Contain at least one special character</li>
                                            </ul>
                                        </small>
                                        </p>
                                    @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                        <div class="form-group">
                            <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>

                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>
                        </div>
                        <div class="form-group login_here_div">
                                <button type="submit" class="btn btn-primary primary-btn">
                                    {{ __('Register Account') }}
                                </button>
                                <span class="signup_btn_a login_here_btn">Have an account? <a href="{{route('login')}}">Login here</a></span>
                        </div>

                    </form>


                        </div>
                    </div>
                </div>

        </div>
    </div>
</section>
<!-- dashboard Section End -->


@endsection
