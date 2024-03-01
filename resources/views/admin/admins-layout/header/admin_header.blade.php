
 <header class="header-top" header-theme="light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between">
                        <div class="top-menu d-flex align-items-center">
                            <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                          
                           
                            <div class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </div>
                        </div>
                        <div class="top-menu d-flex align-items-center">
                           
                            <div class="dropdown text-right">
                                <a class="dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    
                                    <img class="avatar" src="{{AdminsProfileImageById(Auth::guard('admin')->user()->id)}}" alt="">
                                    </a>
                              <span>Super Admin</span>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                                    <a class="dropdown-item" href="{{route('admin.profile')}}"><i class="ik ik-user dropdown-icon"></i> Profile</a>
                                     <a class="dropdown-item" href="{{route('admin.password')}}"><i class="ik ik-user dropdown-icon"></i> Change Password</a>
                                   
                                    <a class="dropdown-item" href="{{route('admin.logout')}}"><i class="ik ik-power dropdown-icon"></i> Logout</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </header>