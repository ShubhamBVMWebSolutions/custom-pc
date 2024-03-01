@extends('admin.admins-layout.admin_master')
@section('title', 'Profile Info')
@section('content')
<div class="page-wrap">
   <div class="main-content">
      <div class="container-fluid">
         <div class="row">
            <div class="col-md-12 tracker-form">
               <div class="card">
                  @if(isset($successMsg) && !empty($successMsg))
                  <div class="alert alert-success" role="alert">
                     {{$successMsg}}
                  </div>
                  @endif
                  @if(isset($errorMsg) && !empty($errorMsg))
                  <div class="alert alert-danger" role="alert">
                     {{$errorMsg}}
                  </div>
                  @endif
                  <form class="form-horizontal" method="post" id="adminprofile" action="{{route('admin.profile')}}" enctype="multipart/form-data">
                     @csrf
                     <div class="card-body">
                        <div class="border-bottom ad-se">
                           <h4 class="card-title">Admin Info</h4>
                        </div>
                        <div class="form-group row">
                           
                           <div class="col-sm-12">
                              <div class="row admin_info02">
                                 <div class="col-sm-12 border-bottom">
                                    <div class="profile_col02">
                                       <img src="{{url('uploads/profile_images/'.$adminUserInfo->profile_image)}}" height="80" width="80">
                                       <label for="lname" class=" control-label col-form-label">Change Image
                                       <span class="change_image02">
                                       <input type="hidden" name="old_profile_image" value="{{$adminUserInfo->profile_image}}">
                                       <input type="file" class="form-control" name="profile_image" accept="image/x-png,image/gif,image/jpeg">
                                       </span>
                                       </label>
                                    </div>
                                 </div>
                                 <!-- <div class="col-sm-12">
                                    <input type="hidden" name="old_profile_image" value="{{$adminUserInfo->profile_image}}">
                                    <input type="file" class="form-control" name="profile_image" accept="image/x-png,image/gif,image/jpeg">
                                    </div> -->
                                 <div class="col-sm-6">
                                    <label for="lname" class=" control-label col-form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ $adminUserInfo->name ?? ''}}" required="">
                                 </div>
                                 <div class="col-sm-6">
                                    <label for="lname" class=" control-label col-form-label">E-mail</label>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ $adminUserInfo->email ?? ''}}" required="">
                                 </div>
                                 <div class="col-sm-6">
                                    <label for="lname" class=" control-label col-form-label">First Name</label>
                                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="{{ $adminUserInfo->first_name ?? ''}}" >
                                 </div>
                                 <div class="col-sm-6">
                                    <label for="lname" class=" control-label col-form-label">Last Name</label>
                                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="{{ $adminUserInfo->last_name ?? ''}}" >
                                 </div>
                                 <div class="col-sm-12">
                                    <div style="margin-top: 15px;"> 
                                       <button type="Submit" class="btn btn-primary">Update</button>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection

