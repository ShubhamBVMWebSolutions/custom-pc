@extends('admin.admins-layout.admin_master')
@section('title', Config::get('constants.ADMIN_PAGE_TITLE.PRODUCT'))
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
                                        <h5><a href="{{route('admin.add.product')}}"><i class="ik ik-plus bg-blue"></i> Add New</a></h5>
                                        <div class="d-inline">
                                             <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.PRODUCT')}}</h5>
                                            <span>All Products</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">{{Config::get('constants.ADMIN_PAGE_TITLE.PRODUCT')}}</li>
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
                                                    <th>#ID</th>
                                                    <th>Title</th>
                                                    <th>Price</th>
                                                    <th>SKU</th>
                                                    <th>Product Type</th>
                                                    <th>Image</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @if($productsCount>0)
                                                   @foreach($products as $key=>$product)
                                                     <tr id="tbl_record_{{$product->id}}">
                                                        <td>{{$product->id}}</td>
                                                        <td>{{$product->title ?? ''}}</td>
                                                        <td>{{$product->price}}</td>
                                                        <td>{{$product->sku}}</td>
                                                        <td>{{$product->product_type}}</td>
                                                        <td> @if(!empty($product->image))
                                                            <img src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$product->image)}}" class="table-user-thumb" alt="">
                                                            @endif
                                                        </td>
                                                        <td>{{$product->created_at ?? ''}}</td>
                                                        <td>
                                                           <center>
                                                         <span id="span_status_{{$product->id}}">
                                                         @if($product->status==1)
                                                           <a href="javascript:void(0)" class="product_change_status" id="product_{{$product->id}}_inactive">
                                                             <i class=" fas fa-check-circle fa-2x" style="color:green"  data-toggle="tooltip" data-original-title="Product current status is active. Click here if you want to make Inactive"></i>
                                                          </a>
                                                          @else
                                                            <a href="javascript:void(0)" class="product_change_status" id="product_{{$product->id}}_active"><i class=" fas fa-times-circle fa-2x" style="color:red" data-toggle="tooltip" data-original-title="Product current status is Inactive. Click here if you want to make Active"></i>
                                                             </a>
                                                          @endif
                                                        </span>
                                                          </center>

                                                        </td>
                                                        <td>
                                                          <a href="{{route('admin.update.product',['encproductId'=>$product->id])}}" title="Edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                          <a href="javascript:void(0)" class="ajax_delete_product" id="product_{{$product->id}}"><i class="ik ik-trash-2 f-16 text-red" data-toggle="tooltip" data-original-title="Click here for delete it"></i></a>
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#ID</th>
                                                    <th>Title</th>
                                                    <th>Price</th>
                                                    <th>SKU</th>
                                                    <th>Product Type</th>
                                                    <th>Image</th>
                                                    <th>Date</th>
                                                    <th>Status</th>
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