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
         @if(Session::has('successMsg'))
         <div class="alert alert-success" role="alert">
            {{ Session::get('successMsg') }}
         </div>
         @endif
         @if(Session::has('errorMsg'))
         <div class="alert alert-danger" role="alert">
            {{ Session::get('errorMsg') }}
         </div>
         @endif
         @if(isset($errorMsg) && !empty($errorMsg))
         <div class="alert alert-danger" role="alert">
            {{$errorMsg}}
         </div>
         @endif
         @foreach ($errors->all() as $error)
         <div class="alert alert-danger" role="alert">
            {{$error}}
         </div>
         @endforeach
         <form class="form-horizontal" method="post" id="adminprofile" action="{{route('admin.password')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
               <div class="border-bottom ad-se">
                  <h4 class="card-title">Admin update password</h4>
               </div>
               <div class="form-group row">
                  <div class="col-sm-2">
                  </div>
                  <div class="col-sm-8">
                     <label for="lname" class=" control-label col-form-label">New password</label>
                     <input type="password" class="form-control" id="password" name="password" placeholder="password"  required="">
                     <label for="lname" class=" control-label col-form-label">Confirm password</label>
                     <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="confirm password" value="" required="" >
                     <div class="border-top">
                        <div class="card-body">
                           <button type="Submit" class="btn btn-primary">Update</button>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-2">
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

