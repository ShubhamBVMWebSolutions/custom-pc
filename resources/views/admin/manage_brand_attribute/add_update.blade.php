@extends('admin.admins-layout.admin_master')
@section('title', 'Add Update Brand Attribute')
@section('content')


<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a></li>
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

                     <div class="d-inline">
                        <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.MANAGE_BRAND_ATTR')}}</h5>
                        <span>Add/Update Brand Attribute</span>
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
           @if(isset($brandattrdetails) && !empty($brandattrdetails->id))
                     <form class="forms-sample" action="{{route('admin.add.update.brand.attr',['encBrandAttrId'=>$brandattrdetails->id])}}" method="post" enctype="multipart/form-data">
                        @else
             <form class="forms-sample" action="{{route('admin.add.update.brand.attr')}}" method="post" enctype="multipart/form-data">
                   @endif
                     @csrf
            <div class="row">
                <div class="col-md-2"></div>
              <div class="col-md-8">
                <div class="card">
                   <div class="card-body">

                         <div class="form-group">
                           <label for="exampleInputUsername1">Brand Category</label>
                           {{-- <input type="text" name="name" class="form-control" value="{{$brandattrdetails->name ?? old('name')}}"> --}}
                           <select name="brand_category"  class="form-control" id="brand_category" required>
                            <option value="">Select A Brand Category</option>
                            @foreach ($product_categories as $cat)
                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                            @endforeach
                           </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputUsername1">Brand Name</label>
                            <input type="text" name="name" class="form-control" value="{{$brandattrdetails->name ?? old('name')}}">
                         </div>

                        <div class="form-group">
                           <label for="exampleInputUsername1">Brand Description</label>
                           <textarea name="description" id="content">{{$brandattrdetails->description ?? old('nadescriptionme')}}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Meta Keyword SEO (Separate By Comma)</label>
                            <input type="text" class="form-control" name="meta_keywords" id="meta_keywords" value="{{$brandattrdetails->meta_keywords?? old('meta_keywords')}}">
                        </div>

                        <div class="form-group">
                            <label>Meta Description SEO</label>
                            <textarea class="form-control" name="meta_description" rows="3">{{$brandattrdetails->meta_description?? old('meta_description')}}</textarea>
                        </div>

                        <div class="row">
                       <div class="form-group col-md-4">
                           <label>Banner</label>
                           <br>
                           @if(isset($brandattrdetails->banner) && !empty($brandattrdetails->banner))
                           <div class="">
                           <img class="backpanel_member_img" src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$brandattrdetails->banner )}}"  height="80" width="80">
                           <input type="hidden" name="old_banner" value="{{$brandattrdetails->banner}}">
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

                        @if(isset($brandattrdetails) && !empty($brandattrdetails->id))
                     <div class="form-group-full01">
                     <button type="submit" class="btn btn-primary mr-2">Update</button>
                     </div>
                     @else
                     <div class="form-group-full01">
                    <button type="submit" class="btn btn-primary ml-2">Publish</button>
                    </div>
                     @endif

                  </div>
               </div>
            </div>
            <div class="col-md-2"></div>
        </div>



        </form>

      </div>
   </div>
</div>







        </div>

<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script>
   CKEDITOR.replace( 'content' );
</script>


@endsection
