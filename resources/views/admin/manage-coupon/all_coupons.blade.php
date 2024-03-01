@extends('admin.admins-layout.admin_master')
@section('title', 'Manage Coupons')
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
                                        <h5><a href="{{route('admin.add.update.coupon')}}"><i class="ik ik-plus bg-blue"></i> Add New</a></h5>
                                        <div class="d-inline">
                                             <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.MANAGE_COUPON')}}</h5>
                                            <span>All Coupons</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">{{Config::get('constants.ADMIN_PAGE_TITLE.MANAGE_COUPON')}}</li>
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
                                                    <th>Coupon Code</th>
                                                    <th>Discount Type</th>
                                                    <th>Coupon Amount</th>
                                                    <th>Use Limit</th>
                                                    <!--<th>Used</th>-->
                                                    <th>Expiry Date</th>
                                                    <th>Created Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @if($coupons->count() > 0)
                                                   @foreach($coupons as $key=>$coupon)
                                                     <tr id="tbl_record_{{$coupon->id}}">
                                                        <td>{{$coupon->id}}</td>
                                                        <td>{{$coupon->coupon_code ?? ''}}</td>
                                                        <td style="text-transform: capitalize;">{{$coupon->discount_type ?? ''}}</td>
                                                        <td>{{$coupon->coupon_amount ?? ''}}</td>
                                                        <td>{{$coupon->use_limit ?? ''}}</td>
                                                        <!--<td>{{$coupon->used ?? ''}}</td>-->
                                                        <td>{{$coupon->expiry_time ?? ''}}</td>
                                                        <td>{{$coupon->created_at ?? ''}}</td>
                                                        <td>
                                                          <a href="{{route('admin.add.update.coupon',['encCouponId'=>$coupon->id])}}" title="Edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                          <a href="javascript:void(0)" class="ajax_delete_coupon" id="coupon_{{$coupon->id}}"><i class="ik ik-trash-2 f-16 text-red" data-toggle="tooltip" data-original-title="Click here for delete it"></i></a>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#ID</th>
                                                    <th>Coupon Code</th>
                                                    <th>Discount Type</th>
                                                    <th>Coupon Amount</th>
                                                    <th>Use Limit</th>
                                                    <!--<th>Used</th>-->
                                                    <th>Expiry Date</th>
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