@include('admin.admins-layout.header.admin_header_landing')
    <body class="sidebar-mini">
      <!-- Preloader -->
  <!--<div class="preloader flex-column justify-content-center align-items-center">-->
  <!--  <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">-->
  <!--</div>-->

        <div class="wrapper">
              @include('admin.admins-layout.header.admin_header')

               <div class="page-wrap">

                <div class="">
                    
                    @include('admin.admins-layout.sidebar_left')

                </div>

                <div class="content-wrapper">
                @yield('content')
                </div>
                
           </div>
    </div>
        
        
      @include('admin.admins-layout.footer.footer')
    </body>
</html>
