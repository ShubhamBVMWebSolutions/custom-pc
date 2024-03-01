@extends('admin.admins-layout.admin_master')
@section('title', 'Update Home Page Sections')
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
                        <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.MANAGE_HOME')}}</h5>
                        <span>Update Home Page Sections</span>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <nav class="breadcrumb-container" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Update</li>
                     </ol>
                  </nav>
               </div>
            </div>
         </div>

         <table class="table table-bordered table-striped mb-4">
            <thead>
               <tr>
                  <th>Section name</th>
                  <th>Status</th>     
               </tr>
            </thead>
            <tbody>
               @foreach($homeSection as $item)
                  <tr>
                     <td>{{$item->section_name}}</td>
                     <td>
                        <input data-id="{{$item->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $item->status ? 'checked' : '' }}>
                     </td>
                  </tr>
               @endforeach
            </tbody>
         </table>





         
         

         <div class="row">
             <div class="col-md-12">
               
                  
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
               
<form class="forms-sample" action="{{route('admin.update.home')}}" method="post" enctype="multipart/form-data">
                        
                        @csrf 
                         <div class="row">
                             <div class="col-md-12"><h2>Shop Prebuilt Section</h2></div>
                        <div class="col-md-8">
                        
                        <div class="row">
                            <div class="col-md-12">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Section Title</label>
                           <input type="text" name="title1" class="form-control" placeholder="Enter Title" value="{{homepagesectionById(1)->section_title}}" required>
                        </div>
                        </div>
                        
                        <div class="col-md-12">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Section Content</label>
                           <textarea id="content" rows="10" cols="100" class="form-control" name="content1" placeholder="Page content" required>{{homepagesectionById(1)->content}}</textarea>
                        </div>
                        </div>
                        
                        <div class="col-md-12">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Section Link</label>
                           <input type="url" name="link1" class="form-control" value="{{homepagesectionById(1)->section_link ?? ''}}" required>
                        </div>
                        </div>
                        
                        
                        </div>
                    
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                           <label>Section Image</label>
                           <br>
                           @if(isset(homepagesectionById(1)->image ) && !empty(homepagesectionById(1)->image ))
                           <img class="backpanel_member_img" src="{{url(Config::get('constants.HOME_IMAGES_PATH').homepagesectionById(1)->image )}}"  height="300" width="400">
                           @endif
                        <input type="file" name="section_image1" class="file-upload-default" accept=".png, .jpg, .jpeg" >
                         <input type="hidden" name="old_section_img" value="{{homepagesectionById(1)->image ?? ''}}">
                           <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                              <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                           </div>
                        </div>
                        
                        <div class="form-group-full01 text-right">
                        <input type="hidden" name="section_id" value="1">
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        </div>
                        </div>
                        </div>  
        
                </form> 
    <hr>            
<form class="forms-sample" action="{{route('admin.update.home')}}" method="post" enctype="multipart/form-data">
                        
                        @csrf 
                         <div class="row">
                             <div class="col-md-12"><h2>Custom Gaming Section</h2></div>
                        <div class="col-md-8">
                        
                        <div class="row">
                            <div class="col-md-12">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Section Title</label>
                           <input type="text" name="title2" class="form-control" placeholder="Enter Title" value="{{homepagesectionById(2)->section_title ?? ''}}" required>
                        </div>
                        </div>
                        
                        <div class="col-md-12">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Section Content</label>
                           <textarea id="content" rows="10" cols="100" class="form-control" name="content2" placeholder="Page content" required>{{homepagesectionById(2)->content ?? ''}}</textarea>
                        </div>
                        </div>
                        
                         <div class="col-md-12">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Section Link</label>
                           <input type="url" name="link2" class="form-control" value="{{homepagesectionById(2)->section_link ?? ''}}" required>
                        </div>
                        </div>
                        
                        
                        </div>
                    
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                           <label>Section Image</label>
                           <br>
                           @if(isset(homepagesectionById(2)->image ) && !empty(homepagesectionById(2)->image ))
                           <img class="backpanel_member_img" src="{{url(Config::get('constants.HOME_IMAGES_PATH').homepagesectionById(2)->image )}}"  height="300" width="400">
                           @endif
                        <input type="file" name="section_image2" class="file-upload-default" accept=".png, .jpg, .jpeg" >
                         <input type="hidden" name="old_section_img2" value="{{homepagesectionById(2)->image ?? ''}}">
                           <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                              <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                           </div>
                        </div>
                        
                        <div class="form-group-full01 text-right">
                        <input type="hidden" name="section_id2" value="2">
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        </div>
                        </div>
                        </div>  
        
                </form> 
        <hr>        
<form class="forms-sample" action="{{route('admin.update.home')}}" method="post" enctype="multipart/form-data">
                        
                        @csrf 
                         <div class="row">
                             <div class="col-md-12"><h2>Best Gaming PC Section</h2></div>
                        <div class="col-md-8">
                        
                        <div class="row">
                            <div class="col-md-12">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Section Title</label>
                           <input type="text" name="title3" class="form-control" placeholder="Enter Title" value="{{homepagesectionById(3)->section_title ?? ''}}" required>
                        </div>
                        </div>
                        
                        <div class="col-md-12">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Section Content</label>
                           <textarea id="content" rows="10" cols="100" class="form-control" name="content3" placeholder="Page content" required>{{homepagesectionById(3)->content ?? ''}}</textarea>
                        </div>
                        </div>
                        
                         <div class="col-md-12">
                         <div class="form-group">
                           <label for="exampleInputJapanese">Section Link</label>
                           <input type="url" name="link3" class="form-control" value="{{homepagesectionById(3)->section_link ?? ''}}" required>
                        </div>
                        </div>
                        
                        
                        </div>
                    
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                           <label>Section Image</label>
                           <br>
                           @if(isset(homepagesectionById(3)->image ) && !empty(homepagesectionById(3)->image ))
                           <img class="backpanel_member_img" src="{{url(Config::get('constants.HOME_IMAGES_PATH').homepagesectionById(3)->image )}}"  height="300" width="400">
                           @endif
                        <input type="file" name="section_image3" class="file-upload-default" accept=".png, .jpg, .jpeg" >
                         <input type="hidden" name="old_section_img3" value="{{homepagesectionById(3)->image ?? ''}}">
                           <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                              <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                           </div>
                        </div>
                        
                        <div class="form-group-full01 text-right">
                        <input type="hidden" name="section_id3" value="3">
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        </div>
                        </div>
                        </div>  
        
                </form> 
  </div>
  </div>
  </div>

         
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
   $( document ).ready(function() {
      $('.toggle-class').change(function() {
         var status = $(this).prop('checked') == true ? 1 : 0;
         var section_id = $(this).data('id');
         $.ajax({
            type: "GET",
            dataType: "json",
            url: "{{Route('admin.home-section-change-status')}}",
            data: {'status': status, 'section_id': section_id},
            success: function(data){
              console.log(data.success)
            }
         });
      })
   });
</script>
<script>
   CKEDITOR.replace( 'content' );
</script> 
         
         
@endsection