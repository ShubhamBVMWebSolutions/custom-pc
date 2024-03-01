@extends('admin.admins-layout.admin_master')
@section('title', 'Add New User')
@section('content')

<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    
    <section class="content">
      <div class="container-fluid">
        <div class="page-header">
            <div class="row align-items-end">
               <div class="col-lg-8">
                  <div class="page-header-title">
                     <i class="ik ik-edit bg-blue"></i>
                     <div class="d-inline">
                        <h5>Add New User</h5>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <nav class="breadcrumb-container" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>
                 
         <div class="row">
             <div class="col-md-12">
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
             </div>
         </div>
         <div class="card">
            <div class="card-body">
                     <form class="forms-sample" action="{{route('admin.add.user')}}" method="post" enctype="multipart/form-data">
                        
                        @csrf 
                         <div class="row">
                        <div class="col-md-8">
                        
                        <div class="row">
                            <div class="col-md-6">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Username</label>
                           <input type="text" name="name" class="form-control" value="{{old('username')}}" placeholder="Enter Username" required>
                        </div>
                        </div>
                        
                        <div class="col-md-6">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Email</label>
                           <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="Enter Email" required>
                        </div>
                        </div>
                        
                        <div class="col-md-6">
                         <div class="form-group">
                           <label for="exampleInputJapanese">First Name</label>
                           <input type="text" name="first_name" class="form-control" value="{{old('first_name')}}" placeholder="Enter First Name" required>
                        </div>
                        </div>
                        
                        <div class="col-md-6">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Last Name</label>
                           <input type="text" name="last_name" class="form-control" value="{{old('last_name')}}" placeholder="Enter Last Name" required>
                        </div>
                        </div>
                        
                        <div class="col-md-6">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Password</label>
                           <input type="password" name="password" class="form-control" required>
                        </div>
                        </div>
                       
                        </div>
                        
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                           <label>Profile Photo</label>
                           <br>
                           
                           <input type="file" name="image" class="file-upload-default" accept=".png, .jpg, .jpeg">
                           <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                              <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                           </div>
                        </div>
                            </div>
                            
                             
                        </div> 
                                
                                <div class="row"> 
                       <div class="col-md-12">
                        <div class="form-group-full01">
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        </div>
                       
                        </div>
                        </div>
                            </div>
                             
            </div>  
        
        </form> 
  </div>
  </div>
  </div>

         
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

         
         
         
          
@endsection