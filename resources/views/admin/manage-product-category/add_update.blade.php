@extends('admin.admins-layout.admin_master')
@section('title', 'Add Update Product Category')
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
                      <h5><a href="{{route('admin.product.category.view')}}"><i class="ik ik-edit bg-blue"></i> View All</a></h5>
                     <div class="d-inline">
                        <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.PRODUCTCATEGORY')}}</h5>
                        <span>Add/Update</span>
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
             @if(isset($productcatDetail) && !empty($productcatDetail->id))
                     <form class="forms-sample" action="{{route('admin.add.update.product.category',['encProductCategoryId'=>$productcatDetail->id])}}" method="post" enctype="multipart/form-data">
                        @else
                     <form class="forms-sample" action="{{route('admin.add.update.product.category')}}" method="post" enctype="multipart/form-data">
                        @endif
                        @csrf 
                         <div class="row">
                             <div class="col-md-1"></div>
                        <div class="col-md-10">
                            <div class="row">
                                <div class="col-md-12">
                         <div class="form-group">
                           <label for="exampleInputenglish">Category Title</label>
                           <input type="text" name="title" class="form-control" placeholder="Enter Category Title" value="{{$productcatDetail->title ?? old('title')}}">
                        </div>
                        </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                         <div class="form-group">
                           <label>Category Description</label>
                           <textarea id="content" rows="5" class="form-control" name="description" placeholder="Category Description">{{$productcatDetail->description?? old('description')}}</textarea>
                       </div>
                       </div>
                       </div>
                       
                       <div class="form-group">
                            <label>Meta Keyword SEO (Separate By Comma)</label>
                            <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{$productcatDetail->meta_keywords?? old('meta_keywords')}}">
                        </div>
                        
                        <div class="form-group">
                            <label>Meta Description SEO</label>
                            <textarea class="form-control" name="meta_description" rows="3">{{$productcatDetail->meta_description?? old('meta_description')}}</textarea>
                        </div>
                       
                       <div class="row">
                       <div class="form-group col-md-4">
                           <label>Icon Image</label>
                           <br>
                           @if(isset($productcatDetail->small_icon) && !empty($productcatDetail->small_icon))
                           <div class="">
                           <img class="backpanel_member_img" src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$productcatDetail->small_icon )}}"  height="80" width="80">
                           <input type="hidden" name="old_small_icon" value="{{$productcatDetail->small_icon}}">
                           </div>
                           @endif
                        <input type="file" name="small_icon" class="file-upload-default" accept=".png, .jpg, .jpeg">
                           <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                              <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                           </div>
                        </div>
                        </div>
                        
                         <div class="row">
                       <div class="form-group col-md-4">
                           <label>Banner</label>
                           <br>
                           @if(isset($productcatDetail->banner) && !empty($productcatDetail->banner))
                           <div class="">
                           <img class="backpanel_member_img" src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$productcatDetail->banner )}}"  height="80" width="80">
                           <input type="hidden" name="old_banner" value="{{$productcatDetail->banner}}">
                           </div>
                           @endif
                        <input type="file" name="banner" class="file-upload-default" accept=".png, .jpg, .jpeg">
                           <div class="input-group col-xs-12">
                              <input type="text" class="form-control file-upload-info" disabled="" placeholder="Upload Image">
                              <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                              </span>
                           </div>
                        </div>
                        </div>
                       
                       <div class="row"> 
                       <div class="col-md-12">
                        @if(isset($productcatDetail) && !empty($productcatDetail->id))
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
                            <div class="col-md-1"></div>
                             
            </div>  
        
        </form> 
  </div>
  </div>
  </div>

         
<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace( 'content' );
</script>          
                  
@endsection