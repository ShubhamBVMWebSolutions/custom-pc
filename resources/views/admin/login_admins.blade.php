<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Login | BNM Web Solutions - Admin</title>
        <meta name="description" content="">
        <meta name="keywords" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--<link rel="icon" href="../favicon.ico" type="image/x-icon" />-->

        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

        <link rel="stylesheet" href="{{asset('admin-panel/plugins/bootstrap/dist/css/bootstrap.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/fontawesome-free/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/ionicons/dist/css/ionicons.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/icon-kit/dist/css/iconkit.min.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/plugins/perfect-scrollbar/css/perfect-scrollbar.css')}}">
        <link rel="stylesheet" href="{{asset('admin-panel/dist/css/theme.min.css')}}">
        <script src="{{asset('admin-panel/src/js/vendor/modernizr-2.8.3.min.js')}}"></script>
         <link rel="stylesheet" href="{{asset('admin-panel/style_admin.css')}}">
    </head>

    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100 bg-white">
                    <div class="col-xl-6 col-lg-6 col-md-6 p-0 d-md-block d-lg-block d-sm-none d-none">
                 <div class="lavalite-bg" style="background-image: url({{asset('admin-panel/img/auth/hub-pc.png')}})">
                            <div class="lavalite-overlay"></div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 my-auto p-0">
                        <div class="authentication-form mx-auto">
                            <div class="logo-centered">
                                <img src="{{asset('img/logo-sultan.svg')}}" alt="" height="55">
                            </div>
                            <h3>BNM Web Solutions Admin Login</h3>
                            <form action="{{url('/web-admin/login')}}" method="post">
                                 @csrf
                                <div class="form-group">
                                    <input type="text" name="name" class="form-control" placeholder="Name" required="" value="{{old('name')}}">
                                    <i class="ik ik-user"></i>
                                </div>
                                 @if ($errors->has('name'))
                                      <div class= "alert alert-danger admin_login_alert">
                                        {{ $errors->first('name') }}
                                    </div>
                                     @endif

                                <div class="form-group admin_pass_box">
                                    <input type="password" class="form-control" name="password" id="id_password" placeholder="Password" required="" value="{{old('password')}}">
                                    <i class="ik ik-lock"></i>
                                    <div class="view_pass_div"><i class="far fa-eye" id="togglePassword" style=""></i></div>
                                </div>
                                 @if ($errors->has('password'))
                                         <div class = "alert alert-danger admin_login_alert">{{ $errors->first('password') }}</div>
                                    @endif

                                    @if(session()->has('Invalid_credensial'))
                                        <div class = "alert alert-danger admin_login_alert">{{session()->get('Invalid_credensial')}}
                                        </div>
                                     @endif

                                      @if(session()->has('alert-error'))
                                        <div class = "alert alert-danger admin_login_alert">{{session()->get('alert-error')}}
                                        </div>
                                     @endif
                                <div class="row">
                                  <!--   <div class="col text-left">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="option1">
                                            <span class="custom-control-label">&nbsp;Remember Me</span>
                                        </label>
                                    </div> -->
                                   <!--  <div class="col text-right">
                                        <a href="forgot-password.html">Forgot Password ?</a>
                                    </div> -->
                                </div>
                                <div class="sign-btn text-center">
                                    <button type="submit" class="btn btn-theme admin-login-btn">Sign In</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{asset('admin-panel/js/jquery-3.3.1.min.js')}}"></script>
       <!--  <script>window.jQuery || document.write('<script src="../src/js/vendor/jquery-3.3.1.min.js"><\/script>')</script> -->
        <script src="{{asset('admin-panel/plugins/popper.js/dist/umd/popper.min.js')}}"></script>
        <script src="{{asset('admin-panel/plugins/bootstrap/dist/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('admin-panel/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js')}}"></script>
        <script src="{{asset('admin-panel/plugins/screenfull/dist/screenfull.js')}}"></script>
        <script src="{{asset('admin-panel/dist/js/theme.js')}}"></script>

        <script>
            const togglePassword = document.querySelector('#togglePassword');
  const password = document.querySelector('#id_password');

  togglePassword.addEventListener('click', function (e) {
    // toggle the type attribute
    const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
    password.setAttribute('type', type);
    // toggle the eye slash icon
    this.classList.toggle('fa-eye-slash');
});
        </script>
    </body>
</html>
