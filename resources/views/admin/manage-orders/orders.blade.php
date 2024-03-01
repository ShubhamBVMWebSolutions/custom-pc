@extends('admin.admins-layout.admin_master')
@section('title', 'Manage Orders')
@section('content')
<div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Orders</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Orders</li>
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
                                             <h5>All Orders</h5>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">{{Config::get('constants.ADMIN_PAGE_TITLE.MANAGE_ORDERS')}}</li>
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
                                                    <th>#Order ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
                                                    <th>Date</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @if($orders->count() > 0)
                                                   @foreach($orders as $key=>$order)
                                                   <?php
                                                  
                                                   $billingAddress = '';
                                                    $user_id = $order->user_id ?? '';
                                                    if(!empty($user_id)){
                                                        $billingAddress = billingAddressByUserId($user_id);
                                                    }
                                                    else{
                                                      $billingAddress = billingAddressByOrderId($order->id);  
                                                    }
                                                   $fname = $billingAddress->first_name ?? '';
                                                   $lname = $billingAddress->last_name ?? '';
                                                   $full_name = '';
                                                   $full_name = $fname.' '.$lname;
                                                   ?>
                                                     <tr id="tbl_record_{{$order->id}}">
                                                        <td>{{$order->id}}</td>
                                                        <td>{{$full_name}}</td>
                                                        <td>NPR {{number_format($order->total_amount)}}</td>
                                                         <td>{{orderStausByKey($order->order_status)}}</td>
                                                        <td>{{$order->created_at ?? ''}}</td>
                                                        <td>
                                                            
                                                          <a href="{{route('admin.update.order',['encOrderId'=>$order->id])}}" title="Edit"><i class="ik ik-edit f-16 mr-15 text-green"></i></a>
                                                          <a href="javascript:void(0)" class="ajax_delete_order" id="order_{{$order->id}}"><i class="ik ik-trash-2 f-16 text-red" data-toggle="tooltip" data-original-title="Click here for delete it"></i></a>
                                                            <a href="{{route('order.createInvoice',['order_id'=>$order->id])}}" title="Download Invoice" ><i style="margin-left:10px;" class="f-16 fa fa-download text-green" aria-hidden="true"></i></a>
                                                    </tr>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>#ID</th>
                                                    <th>Customer Name</th>
                                                    <th>Total</th>
                                                    <th>Status</th>
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