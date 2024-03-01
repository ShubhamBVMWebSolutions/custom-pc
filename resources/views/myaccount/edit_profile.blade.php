@extends('front-layout.master_layout')
@section('title', 'Edit Profile')
@section('content')

<?php $user_id = auth()->id();
if(empty($user_id)){ ?>
<script>window.location = "{{route('login')}}";</script>
<?php die; }?>

<!-- dashboard Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="cart_title">Account Details</h2>
                </div>
            </div>

<div class="row">
    <div class="col-lg-12">
    @include('myaccount.nav')

            <div id="secondTab" class="tabcontent">
              <h3>Edit Profile</h3>
                  <div class="edit_profile_tabs">
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
                  <strong>Success!</strong> {{ session()->get('alert-error') }}
               </div>
               @endif
                      <form method="post" action="{{route('user.dashboard.profile')}}" enctype="multipart/form-data">
                          @csrf
                          <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                     <span class="ec-register-wrap">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="first_name" value="{{$user_details->first_name}}" placeholder="Enter your first name" required="">
                        </span>
                                  </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="form-group">
                                     <span class="ec-register-wrap">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="{{$user_details->last_name}}" placeholder="Enter your last name" required="">
                        </span>
                                  </div>
                              </div>
                          </div>
                        <div class="form-group">
                        <span class="ec-register-wrap">
                            <label>Profile Image</label>
                            @if(!empty($user_details->image))
                            <img alt="" src="{{url(Config::get('constants.PROFILE_IMAGE_PATH').$user_details->image )}}" height="150" width="150">
                            <input type="hidden" name="old_profile" value="{{$user_details->image}}">
                            <br>
                            @endif
                            <input type="file" name="image" accept=".png, .jpg, .jpeg">
                        </span>
                        </div>
                        <div class="form-group">
                        <span class="ec-register-wrap">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{$user_details->email}}" placeholder="Enter email address" required="">
                        </span>
                        </div>
                        <div class="form-group">
                        <span class="ec-register-wrap">
                            <label>Current Password <small></small></label>
                            <input type="password" class="form-control" name="curr_password" placeholder="Enter Current Password">
                        </span>
                        </div>
                        <div class="form-group">
                        <span class="ec-register-wrap">
                            <label>New Password <small></small></label>
                            <input type="password" class="form-control" name="new_password" placeholder="Enter New Password">
                        </span>
                        </div>
                        <span class="ec-register-wrap">
                            <input class="btn btn-primary" type="submit" value="Save Changes">
                        </span>
                      </form>
                  </div>
            </div>
            </div>
    </div>
    </div>


        </div>
    </div>
</section>
<!-- dashboard Section End -->


@endsection
