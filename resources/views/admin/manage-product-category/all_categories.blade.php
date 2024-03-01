@extends('admin.admins-layout.admin_master')
@section('title', 'Manage Product Categories')
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
                                        <h5><a href="{{route('admin.add.update.product.category')}}"><i class="ik ik-plus bg-blue"></i> Add New</a></h5>
                                        <div class="d-inline">
                                             <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.PRODUCTCATEGORY')}}</h5>
                                            <span>All Product Categories</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">{{Config::get('constants.ADMIN_PAGE_TITLE.PRODUCTCATEGORY')}}</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                                                <div class="row">
                            <div class="col-sm-12">
                               <div class="card">
                                    <div class="card-body">
                                        <div class="dt-responsive table-responsive">
                                            <table id="simpletable"
                                                   class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Icon</th>
                                                    <th>Banner</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @if($productCatCount>0)
                                                   @foreach($productCat as $key=>$category)
                                                     <tr id="tbl_record_{{$category->id}}">
                                                        <td>{{$category->id}}</td>
                                                        <td>{{$category->title ?? ''}}</td>
                                                        @php if(!empty($category->banner)){$smallIcon = url(Config::get('constants.SITE_PRODUCT_IMAGE').$category->small_icon );  }else{ $smallIcon = asset('public/img/soi_icon.png'); } @endphp
                                                        <td><img class="backpanel_member_img" src="{{$smallIcon}}"  width="50" height="50"></td>
                                                        @php if(!empty($category->banner)){$bannerImg = url(Config::get('constants.SITE_PRODUCT_IMAGE').$category->banner );  }else{ $bannerImg = asset('public/img/pc-697642_960_720.jpg'); } @endphp
                                                        <td><img class="backpanel_member_img" src="{{$bannerImg}}"  width="160" height="90"></td>
                                                        <td>{{$category->created_at ?? ''}}</td>
                                                        <td>
                                                          <a href="{{route('admin.add.update.product.category',['encProductCategoryId'=>$category->id])}}" title="Edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                          <a href="javascript:void(0)" class="ajax_delete_category" id="category_{{$category->id}}"><i class="ik ik-trash-2 f-16 text-red" data-toggle="tooltip" data-original-title="Click here for delete it"></i></a>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Title</th>
                                                    <th>Icon</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                   
         
         
         
         
         </div>
         @endsection