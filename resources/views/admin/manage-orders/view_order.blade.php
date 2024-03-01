@extends('admin.admins-layout.admin_master')
@section('title', 'Edit Order')
@section('content')

<?php $user = array();
$user = getUserDetailsById($orderDetails->user_id);
$fname = $user->first_name ?? '';
$lname = $user->last_name ?? '';
$full_name = '';
$full_name = $fname.' '.$lname;

$user_id = $orderDetails->user_id ?? '';
$billingAddress = '';

if(!empty($user_id)){
    $billingAddress = billingAddressByUserId($user_id);
}
else{
  $billingAddress = billingAddressByOrderId($orderDetails->id);
}

$subtotal = 0;
?>

<div class="page-wrap">
   <div class="">
      <div class="container-fluid">
         <div class="page-header">
            <div class="row align-items-end">
               <div class="col-lg-8">
                  <div class="page-header-title">
                     <i class="ik ik-edit bg-blue"></i>
                     <div class="d-inline">
                        <h5>{{Config::get('constants.ADMIN_PAGE_TITLE.VIEW_ORDER')}}</h5>

                     </div>
                  </div>
               </div>
               <div class="col-lg-4">
                  <nav class="breadcrumb-container" aria-label="breadcrumb">
                     <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                           <a href="{{route('admin.dashboard')}}"><i class="ik ik-home"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">View Order</li>
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
                  <strong>Success!</strong> {{ session()->get('alert-error') }}
               </div>
               @endif
               </div>
               </div>

                     <form class="forms-sample" action="{{route('admin.update.order',['encOrderId'=>$orderDetails->id])}}" method="post" enctype="multipart/form-data">

                        @csrf
                    <div class="row">
                       <div class="col-md-9">
                         <div class="card">
                        <div class="card-body">
                            <h2>Order #{{$orderDetails->id}} details</h2>
                            <h5>Pyament via {{paymentMethodnameByCode($orderDetails->payment_method)->title}}.</h5>

                            <div class="row">
                                <div class="col-md-6">
                                    <h6>General</h6>
                                    <div class="form-group order_date_box">
                                        <label>Date Created:</label>
                                       <div class="row">
                                           <div class="col-md-5">
                                              <input type="text" class="readonly_field form-control" value="{{date('Y-m-d',strtotime($orderDetails->created_at))}}" readonly>
                                           </div>
                                           <div class="col-md-2"><p class="text-center">@</p></div>
                                           <div class="col-md-5">
                                               <input type="text" class="readonly_field form-control" value="{{date('H:i:A',strtotime($orderDetails->created_at))}}" readonly>
                                           </div>
                                       </div>
                                    </div>
                                    <div class="form-group order_customr_name_box">
                                        <label>Customer Name</label>
                                        <input type="text" class="form-control" value="{{$full_name}}" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h6>Billing Address</h6>
                                    <address class="billing_address_box">
                                        {{$billingAddress->first_name.' '.$billingAddress->last_name}}<br>
                                        {{$billingAddress->address1}} {{$billingAddress->address2 ?? ''}}<br>
                                        {{$billingAddress->city}} {{$billingAddress->zipcode}}<br>
                                        {{$billingAddress->state}}, {{$billingAddress->country}}
                                    </address>
                                    <div class="form-group billing_email_box">
                                    <label>Email Address:</label>
                                    <a href="maitto:{{$billingAddress->email}}">{{$billingAddress->email}}</a>
                                    </div>
                                    <div class="form-group billing_phone_box">
                                    <label>Phone:</label>
                                    <a href="tel:{{$billingAddress->phone}}">{{$billingAddress->phone}}</a>
                                    </div>
                                    </div>
                            </div>
                      </div>
                      </div>

                      <div class="card">
                        <div class="card-body">
                            <table class="table order_items_table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Item</th>
                                        <th>Cost</th>
                                        <th>Qty</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($orderItems->count() > 0)
                                    @foreach($orderItems as $item)
                                    <?php $prod_id = $item->product_id;
                                    if($prod_id !== '0'){
                                    $prod_detail = productDetailById($prod_id);
                                    $variation_id = $item->variation_id ?? '';
                                    $variation_details = getVariationdetailById($variation_id);

                                    $color_name = '';
                                     if(!empty($variation_details)){
                            $color_id = $variation_details->color_id;
                            $color_detail = clorDetailById($color_id);
                            $color_name =  $color_detail[0]->color_name;
                            }
                                    }
                            $subtotal+=$item->price*$item->quantity;
                            if($prod_id != '0' && !empty($prod_detail)){
                                    ?>
                                    <tr>
                                        <td>
                                            @if(!empty($variation_id))
                                            <?php $variation_imgs = getVariationImageById($variation_id); ?>
                                            <img src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$variation_imgs[0]->variation_image ?? '' )}}"  height="80" width="80">
                                            @else
                                            <img src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$prod_detail->image ?? '' )}}"  height="80" width="80">
                                            @endif
                                        </td>
                                       <td><a href="{{route('admin.update.product',['encproductId' => $prod_id])}}">{{$prod_detail->title}}</a>
                                       @if(!empty($color_name))
                                       <br>
                                       <span><strong>Color:</strong> {{$color_name}}</span>
                                       @endif

                                       @if(!empty($item->capacity))
                                       <br>
                                       <span><strong>Capacity:</strong> {{$item->capacity}}</span>
                                       @endif
                                       </td>
                                       <td>NPR {{number_format($item->price)}}</td>
                                       <td>× {{$item->quantity}}</td>
                                       <td>NPR {{number_format($item->price*$item->quantity)}}</td>
                                    </tr>
                                    <?php }
                                    else{ ?>
                                    <tr><td>A Product is deleted.</td></tr>
                                    <?php } if($prod_id == '0'){ ?>
                                    <tr>
                                        <td>
                                            <img src="{{url('public/img/gift card.png')}}" height="80" width="80">
                                        </td>
                                        <td>
                                            Nominate Value Gift Card
                                        </td>
                                        <td>NPR {{number_format($item->price)}}</td>
                                        <td>× {{$item->quantity}}</td>
                                        <td>NPR {{number_format($item->price*$item->quantity)}}</td>
                                    </tr>
                                    <?php } ?>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="4">Subtotal:</th>
                                        <td>NPR {{number_format($subtotal)}}</td>
                                    </tr>
                                    @if(!empty($orderDetails->coupon_code))
                            <tr>
                                <th colspan="4">Coupon: {{$orderDetails->coupon_code}}</th>
                                <td>- NPR {{number_format($orderDetails->discount_amount)}}</td>
                            </tr>
                            @endif
                                    <tr>
                                        <th colspan="4">Total:</th>
                                        <td>NPR {{number_format($orderDetails->total_amount)}}</td>
                                    </tr>
                                </tfoot>
                            </table>
                    </div>
                    </div>
                       </div>

                        <div class="col-md-3">
                            <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Status</label>
                                <select name="order_status" class="form-control">
                                   <option value="">Select Status</option>
                                   <option value="pending_payment" @if($orderDetails->order_status == 'pending_payment') selected @endif >Pending Payment</option>
                                   <option value="processing" @if($orderDetails->order_status == 'processing') selected @endif >Processing</option>
                                   <option value="dispatched" @if($orderDetails->order_status == 'dispatched') selected @endif >Dispatched</option>
                                   <option value="completed" @if($orderDetails->order_status == 'completed') selected @endif >Delivered</option>
                                   <option value="cancelled" @if($orderDetails->order_status == 'cancelled') selected @endif >Cancelled</option>
                                </select>
                            </div>
                            <!--<div class="form-group">-->
                            <!--    <label>Payment Status</label>-->
                            <!--    <input type="text" class="form-control" value="{{$orderDetails->payment_status}}" readonly>-->
                            <!--    </div>-->
                           <div class="form-group-full01 text-right">
                            <input type="hidden" name="product_id" value="{{ implode(',', $orderItems->pluck('product_id')->toArray()) }}">
                            <input type="hidden" name="product_qty[]" value="{{ implode(',', $orderItems->pluck('quantity')->toArray()) }}">
                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                        </div>
                        </div>
                        </div>
                       </div>
                    </div>


                     </form>



         </div>
      </div>

</div>

@endsection
