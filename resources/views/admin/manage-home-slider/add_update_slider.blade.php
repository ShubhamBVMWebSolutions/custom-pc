@extends('admin.admins-layout.admin_master')
@section('title', 'Add Update Home Slider')
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
                        <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.MANAGE_SLIDER')}}</h5>
                        <span>Add/Update Slider</span>
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
             @if(isset($homesliderdelatis) && !empty($homesliderdelatis->id))
                     <form class="forms-sample" action="{{route('admin.add.update.home.slider',['encsliderId'=>$homesliderdelatis->id])}}" method="post" enctype="multipart/form-data">
                        @else
                     <form class="forms-sample" action="{{route('admin.add.update.home.slider')}}" method="post" enctype="multipart/form-data">
                        @endif
                        @csrf 
                         <div class="row">
                        <div class="col-md-8">
                        
                        <div class="row">
                            <div class="col-md-12">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Slide Title</label>
                           <input type="text" name="title" class="form-control" placeholder="Title" value="{{$homesliderdelatis->title ?? old('title')}}">
                        </div>
                        </div>
                        </div>
                        
                       <div class="row">
                       <div class="col-md-6">
                         <div class="form-group">
                           <label for="exampleInputenglish">Subtitle 1</label>
                           <input type="text" name="text1" class="form-control" placeholder="" value="{{$homesliderdelatis->text1 ?? old('text1')}}">
                        </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                           <label for="exampleInputChinese">Subtitle 2</label>
                           <input type="text" name="text2" class="form-control" value="{{$homesliderdelatis->text2 ?? old('text2')}}">
                        </div>
                        </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                <label>Slide Content</label>
                                <textarea class="form-control" name="content" rows=10>{{$homesliderdelatis->content ?? old('content')}}</textarea>
                                </div>
                            </div>
                        </div>
 
             
                            </div>
                            <div class="col-md-4">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                           <label>Slide Image</label>
                                           <br>
                                           @if(isset($homesliderdelatis->image ) && !empty($homesliderdelatis->image))
                                           <img class="backpanel_member_img" src="{{url(Config::get('constants.HOME_SLIDER_IMAGE_PATHS').$homesliderdelatis->image)}}"  height="250" width="250">
                                           <input type="hidden" name="old_post_image" value="{{$homesliderdelatis->image}}">
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
                                        <div class="form-group">
                                           <label>Background Image</label>
                                           <br>
                                           @if(isset($homesliderdelatis->background_image ) && !empty($homesliderdelatis->background_image))
                                           <img class="backpanel_member_img" src="{{url(Config::get('constants.HOME_SLIDER_IMAGE_PATHS').$homesliderdelatis->background_image)}}"  height="250" width="250">
                                           <input type="hidden" name="old_post_background_image" value="{{$homesliderdelatis->image}}">
                                           @endif
                                           <input type="file" name="background_image" class="file-upload-default" accept=".png, .jpg, .jpeg">
                                          
                                          
                                           <div class="input-group col-xs-12">
                                              <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                              <span class="input-group-append">
                                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                              </span>
                                           </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label >Button Text</label>
                                           <input type="text" name="button_text" class="form-control" value="{{$homesliderdelatis->button_text ?? old('button_text')}}">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label >Button Link</label>
                                           <input type="text" name="button_link" class="form-control" value="{{$homesliderdelatis->button_link ?? old('button_link')}}">
                                        </div>
                                    </div>
                                    
                            
                            <div class="col-md-12">
                        @if(isset($homesliderdelatis) && !empty($homesliderdelatis->id))
                          <div class="form-group">
                           <label>Status</label>
                           <div class="input-group">
                              <label class="display-inline-block custom-control custom-radio ml-1">
                              <input type="radio" name="status" class="custom-control-input" value="1" {{ isset($homesliderdelatis->status) && $homesliderdelatis->status==1 ? 'checked' : ''}}>
                              <span class="custom-control-indicator"></span>
                              <span class="custom-control-label">Active</span>
                              </label>
                              <label class="display-inline-block custom-control custom-radio ml-3">
                              <input type="radio" name="status" class="custom-control-input" value="0" {{isset($homesliderdelatis->status) && $homesliderdelatis->status==0 ? 'checked' : ''}}>
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
                        @if(isset($homesliderdelatis) && !empty($homesliderdelatis->id))
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