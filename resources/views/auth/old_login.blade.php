@extends('front-layout.master_layout')
@section('title','Login')
@section('meta_keywords',metaTagsByKeyPage('login','meta_keywords'))
@section('meta_description',metaTagsByKeyPage('login','meta_description'))
@section('content')


<!-- dashboard Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="cart_title">Login</h2>
                </div>    
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    @if ($errors->any())
               <div class="alert alert-danger alert-dismissible  mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  <ul class="list-unstyled m-0">
                     @foreach ($errors->all() as $error)
                     <li>{{ $error }}</li>
                     @endforeach
                  </ul>
               </div>
               @endif
               
               @if(session()->has('alert-success'))
               <div class="alert alert-success alert-dismissible  mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  <strong>Success!</strong> {{ session()->get('alert-success') }} 
               </div>
               @endif
               @if(session()->has('alert-error'))
               <div class="alert alert-danger alert-dismissible  mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  <strong>Failed!</strong> {{ session()->get('alert-error') }} 
               </div>
               @endif
               @if(session()->has('alert-unverify'))
               <div class="alert alert-danger alert-dismissible  mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  <strong>Failed!</strong> {{ session()->get('alert-unverify') }} <a href="javascript:;" data-toggle="modal" data-target="#resendModalCenter">Resend Link</a>
               </div>
               @endif
                     <form method="POST" action="{{ route('login') }}" class="login_form">
                        @csrf

                        <div class="form-group checkout__input">
                            <P for="email" class="">{{ __('E-Mail Address') }} <span>*</span></P>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="log_email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group checkout__input">
                            <P for="password" class="">{{ __('Password') }} <span>*</span></P>

                           
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="log_password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group remember_box">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <p class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </p>
                                </div>
                           
                        </div>

                        <div class="checkout__input">
                           
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                <span class="signup_btn_a">Need an account? <a class="btn btn-link" href="{{ route('user.register') }}">
                                         Sign up now!
                                    </a></span>
                                

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            
                        </div>
                    </form>
                    
                    <div class="row">
                        <div class="col-md-12 social_logins">
                            <h6 class="login_with">Login With:</h6>
                            <span class="google_login"><a class="google_login_btn" href="{{route('google.auth')}}"><i class="fa fa-google"></i> Continue with Google</a></span>
                            <span class="facebook_login"><a class="fb_login" href="{{route('facebook.auth')}}"><i class="fa fa-facebook"></i> Continue with Facebook</a></span>
                            <span class="twitter_login"><a class="twitter_login" href="{{route('twitter.auth')}}"><i class="fa fa-twitter"></i> Continue with Twitter</a></span>
                            <!--<span class="instagram_login"><a class="instagram_login" href="{{route('instagram.auth')}}"><i class="fa fa-instagram"></i> Continue with Instagram</a></span>-->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <img src="{{url('public/img/undraw_thought_process_re_om58.svg')}}">
                </div>  
            </div>    

        </div>
    </div>
</section>

<!-- Modal -->
<div class="modal fade" id="resendModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Resend Verification Link</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label>Email Address</label>
            <input type="email" id="user_email" class="form-control">
        </div>
        <button type="button" class="btn btn-primary resend_btn btn-lg" id="resend_link">Resend Link</button>
        <div class="succ_send_msg"></div>
      </div>
    </div>
  </div>
</div>
<!-- dashboard Section End -->



@endsection
