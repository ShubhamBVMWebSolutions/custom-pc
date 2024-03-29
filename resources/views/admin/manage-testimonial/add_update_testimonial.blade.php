@extends('admin.admins-layout.admin_master')
@section('title', 'Add Update Testimonial')
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
                        <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.MANAGE_TESTIMONIAL')}}</h5>
                        <span>Add/Update Testimonial</span>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <nav class="breadcrumb-container" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add / Update</li>
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
             @if(isset($testimonialdetails) && !empty($testimonialdetails->id))
                     <form class="forms-sample" action="{{route('admin.add.update.testimonial',['enctestimonialId'=>$testimonialdetails->id])}}" method="post" enctype="multipart/form-data">
                        @else
                     <form class="forms-sample" action="{{route('admin.add.update.testimonial')}}" method="post" enctype="multipart/form-data">
                        @endif
                        @csrf 
                         <div class="row">
                        <div class="col-md-8">
                        
                        <div class="row">
                            <div class="col-md-6">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Name</label>
                           <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{$testimonialdetails->name ?? old('name')}}">
                        </div>
                        </div>
                        
                        <div class="col-md-6">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Company</label>
                           <input type="text" name="company" class="form-control" placeholder="Enter Company Name" value="{{$testimonialdetails->company ?? old('company')}}">
                        </div>
                        </div>
                        
                        <div class="col-md-12">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Content</label>
                           <textarea name="content" rows=10 cols=90 class="form-control">{{$testimonialdetails->content ?? old('content')}}</textarea>
                        </div>
                        </div>
                        </div>
                        
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                           <label>Image</label>
                           <br>
                           @if(isset($testimonialdetails->image ) && !empty($testimonialdetails->image))
                           <img class="backpanel_member_img" src="{{url(Config::get('constants.TESTIMONIAL_IMAGE_PATHS').$testimonialdetails->image)}}"  height="350" width="350">
                           <input type="hidden" name="old_post_image" value="{{$testimonialdetails->image}}">
                           @endif
                           <input type="file" name="image" class="file-upload-default" accept=".png, .jpg, .jpeg">
                          
                          
                           <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                              <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                           </div>
                        </div>
                            </div>
                            
                            <div class="col-md-12">
                        @if(isset($testimonialdetails) && !empty($testimonialdetails->id))
                          <div class="form-group">
                           <label>Status</label>
                           <div class="input-group">
                              <label class="display-inline-block custom-control custom-radio ml-1">
                              <input type="radio" name="status" class="custom-control-input" value="1" {{ isset($testimonialdetails->status) && $testimonialdetails->status==1 ? 'checked' : ''}}>
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-label">Active</span>
                              </label>
                              <label class="display-inline-block custom-control custom-radio ml-3">
                              <input type="radio" name="status" class="custom-control-input" value="0" {{isset($testimonialdetails->status) && $testimonialdetails->status==0 ? 'checked' : ''}}>
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-label">Inactive</span>
                              </label>
                           </div>
                        </div>
                        @endif
                            </div>    
                        </div> 
                                
                                <div class="row"> 
                       <div class="col-md-12">
                        @if(isset($testimonialdetails) && !empty($testimonialdetails->id))
                         <div class="form-group-full01">
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        </div>
                        @else
                        <div class="form-group-full01">
                        <button type="submit" class="btn btn-primary mr-2">Publish</button>
                        </div>
                        @endif
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