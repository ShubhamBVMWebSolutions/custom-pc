@extends('admin.admins-layout.admin_master')
@section('title', 'Manage Gift Card Detail')
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
    <!-- ///Gift card message// -->

    <div class="alert-messages">
               <div style="display: none;" class="alert alert-success alert-success-ajax  alert-dismissible  mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  <strong>Success!</strong> successfully updated date.
               </div>
              
               <div style="display: none;" class="alert alert-danger alert-danger-ajax alert-dismissible  mb-2" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                  </button>
                  <strong>Failed!</strong> Unable to update date.
               </div>
             </div>

    <!-- //Gift card message // -->
    <section class="content">
      <div class="container-fluid">
                   <div class="page-header">
                            <div class="row align-items-end">
                                <div class="col-lg-8">
                                    <div class="page-header-title">
                                        <!-- <h5><a href="{{route('admin.add.update.coupon')}}"><i class="ik ik-plus bg-blue"></i> Add New</a></h5> -->
                                        <div class="d-inline">
                                             <h5>Gift Card</h5>
                                            <span>All Gift Card Detail</span>
                                        </div>
                                    </div>
                                </div>



                               

                                <div class="col-lg-4">
                                    <nav class="breadcrumb-container" aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item">
                                                <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                                            </li>
                                            <li class="breadcrumb-item active" aria-current="page">{{Config::get('constants.ADMIN_PAGE_TITLE.MANAGE_GIFTCARD')}}</li>
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
                                            <table id="simpletables"
                                                   class="table table-striped table-bordered nowrap">
                                                <thead>
                                                <tr>
                                                    <th>#ID</th>
                                                    <th>Full Name</th>
                                                    <th>Recipient Email</th>
                                                    <!-- <th>Giftcard Productkey</th> -->
                                                    <th>Giftcard Number</th>
                                                    <th>Giftcard Pin</th>
                                                    <th>Total Amount</th>
                                                    <th>Remain Amount</th>
                                                    <th>Order Id</th>
                                                    <th>Send By</th>
                                                    <th>Status</th>
                                                    <th>Created Date</th>
                                                   
                                                    <th>Expiry Date</th>
                                                    <th>Action</th>
                                                  
                                                </tr>
                                                </thead>
                                                <tbody>
                                               <?php $i = 1; ?>
                                                  @if($giftcarddetail->count() > 0)
                                                   @foreach($giftcarddetail as $key=>$giftcarddetails)
                                                     <tr id="tbl_record_{{$giftcarddetails->id}}">
                                                        <td >{{$i}}</td> 

                                                        <td>{{$giftcarddetails->full_name ?? ''}}</td>
                                                        <td>{{$giftcarddetails->recipient_emailid ?? ''}}</td>
                                                        <td>{{$giftcarddetails->giftcard_number ?? ''}}</td>
                                                        <td>{{$giftcarddetails->giftcard_pin ?? ''}}</td>
                                                        <td>{{$giftcarddetails->total_amount ?? ''}}</td>
                                                        <td>{{$giftcarddetails->balance_amount ?? ''}}</td>
                                                        <td>{{$giftcarddetails->order_id ?? ''}}</td>
                                                        <td>{{$giftcarddetails->sendby == 'sendbyemail'?'Sent by email':'Sent by post'}}</td>
                                                        <td>{{$giftcarddetails->status == '1'?'Active':'Inactive'}}</td>
                                                        <td>{{$giftcarddetails->created_at ?? ''}}</td>

                                                        @if($giftcarddetails->giftcard_expirydate!='')
                                                      <?php   $date =  date('Y-m-d',strtotime($giftcarddetails->giftcard_expirydate)); ?>
                                                        @else
                                                        <?php   $date =  ''; ?>
                                                        @endif

                                                        <td><input type="date" class="expiry_date" value="<?php echo $date  ?>" /></td>
                                                        <td><button type="submit" value="{{$giftcarddetails->id ?? ''}}" class="btn btn-primary mr-2 submitexpirydate">Update Date</button></td>
                                                      
                                                    </tr>
                                                    <?php  $i++; ?>
                                                    @endforeach
                                                    @endif
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                <th>#ID</th>
                                                    <th>Full Name</th>
                                                    <th>Recipient Email</th>
                                                    <!-- <th>Giftcard Productkey</th> -->
                                                    <th>Giftcard Number</th>
                                                    <th>Giftcard Pin</th>
                                                    <th>Total Amount</th>
                                                    <th>Remain Amount</th>
                                                    <th>Order Id</th>
                                                    <th>Send By</th>
                                                    <th>Status</th>
                                                    <th>Created Date</th>
                                                    <th>Expiry Date</th>
                                                    <th>Action</th>
                                                    
                                                  
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                      </div>
      <script>
                                                        $(document).ready(function () {
    $('#simpletables').DataTable({
        order: [[0, 'DESC']],
    });
});
</script>
         @endsection
         