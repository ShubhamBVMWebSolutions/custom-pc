@extends('front-layout.master_layout')
@section('title', 'Order Placed')
@section('content')

<?php use App\Models\CartSession;
use App\Models\Order;
if(auth()->check()){
    $user_id = auth()->user()->id;
}else{
    $user_id ='';
}

//$user_id = auth()->id;
$order_id = $_GET['order_id'] ?? '';
$order_details = getOrderById($order_id);
$order_items = orderItemsById($order_id);
$subtotal = 0;

//$Mailcontroller = new SetMailController();


if($user_id != $order_details->user_id){
       header("Location: ".route('home'));
    die; 
    }

/*if(empty($user_id)){
    session()->put('order_id',$order_id);
    if(!session()->has('order_id')){
       header("Location: ".route('home'));
    die; 
    }
}*/

session()->forget('cart');
session()->forget('pc_cart');
session()->forget('cooling_cart');
session()->forget('motherboard_cart');
session()->forget('gpu_cart');
session()->forget('cpu_cart');
session()->forget('pwrsupply_cart');
session()->forget('ram_cart');
session()->forget('storage_cart');
session()->forget('monitor_cart');
session()->forget('peripheral_cart');
session()->forget('rgb_cart');
session()->forget('extra_cart');
session()->forget('software_cart');
session()->forget('service_cart');
session()->forget('applied_coupon');


CartSession::where('session_key',$user_id)->delete();
?>

<section class="order_placed_page spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="aos-init aos-animate order_placed text-center">Order Received!</h2>
                <h5 class="text-center mb-5">Thank you! Your order has been placed.</h5>
            </div>
        </div>
        
        <div class="row mb-5 order-received">
            <div class="col-md-3">
                <h6>ORDER NUMBER:</h6>
                <p><strong>{{$order_id}}</strong></p>
            </div>
            <div class="col-md-3">
                <h6>DATE:</h6>
                <p><strong>{{date('F j, Y',strtotime($order_details->created_at))}}</strong></p>
            </div>
            <div class="col-md-3">
                <h6>TOTAL:</h6>
                <p><strong>NPR {{number_format($order_details->total_amount,2)}}</strong></p>
            </div>
            <div class="col-md-3">
                <h6>PAYMENT METHOD:</h6>
                <p><strong>
                    <?php if($order_details->payment_method == 'cod'){
                        echo 'Cash On Delivery';
                        updateOrderStatus($order_id,'processing');
                    }
                    elseif($order_details->payment_method == 'bank_transfer'){
                        echo 'Direct Bank Transfer';
                    }
                    elseif($order_details->payment_method == 'esewa'){
                        echo 'E-Sewa';
                    }
                    elseif($order_details->payment_method == 'khalti'){
                        echo 'Khalti';
                        updateOrderStatus($order_id,'processing');
                    }
                    elseif($order_details->payment_method == 'connect_ips'){
                        echo 'Connect IPS';
                    }
                    ?>
                </strong></p>
            </div>
        </div>
        
        @if($order_details->payment_method == 'bank_transfer')
        <div class="row">
            <div class="col-md-12">
        <h2 class="order_heading">Our Bank Details</h2>
        <?php $bank_accounts = getallbankaccount(); 
        foreach($bank_accounts as $account){ ?>
        <div class="bank_list">
            <h3>{{$account->account_name}}</h3>
            <ul class="bank_account_detail_ul">
                <li class="bank_name">Bank: <strong>{{$account->bank_name}}</strong></li>
                <li class="account_number">Account number: <strong>{{$account->account_number}}</strong></li>
                @if(!empty($account->iban))
                <li class="iban_number">IBAN: <strong>{{$account->iban}}</strong></li>
                @endif
            </ul>
        </div>
        <?php } ?>
        </div>
        </div>
        @endif
        
        <div class="row order_detail_row">
            <div class="col-md-12">
            <h2 class="order_heading">Order Details</h2>
            <table class="table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order_items as $item)
                    <?php $product_id = $item->product_id;
                    $prod_detail = productDetailById($product_id);
                    $subtotal+=$item->price*$item->quantity;?>
                    
                    <tr>
                    
                          @if($product_id == 0)
                        <td><a href="#">Gift Card</a> X {{$item->quantity}}</td>
                        <td>NPR {{number_format($item->price*$item->quantity,2)}}</td>
                        @else   
                        <td>@if(!empty($item->type))
                            <h5 style="text-transform: uppercase;"><strong >{{$item->type}}</strong></h5>
                            @endif
                            <a href="{{route('view.product',['productSlug'=>$prod_detail->slug])}}">{{$prod_detail->title}}</a> X {{$item->quantity}}
                            @if(!empty($item->capacity))
                            <br>
                            <span><strong>Capacity:</strong> {{$item->capacity}}</span>
                            @endif
                            </td>
                        <td>NPR {{number_format($item->price*$item->quantity,2)}}</td>
                        @endif
                    </tr>
                    
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Subtotal:</th>
                        <td><b>NPR {{number_format($subtotal,2)}}</b></td>
                    </tr>
                    @if(!empty($order_details->coupon_code))
                    <?php $coupon_detail = coupondetailByCode($order_details->coupon_code); ?>
                    <tr>
                        <th>Coupon Code: <span class="coupon_code_sp">{{$order_details->coupon_code}}</span></th>
                        <td><b>- NPR {{number_format($order_details->discount_amount,2)}}<b></td>
                    </tr>
                    @endif
                    @if(($order_details->giftcard_code))
                    <tr>
                        <th>Gift Card: <span class="coupon_code_sp">{{$order_details->giftcard_code}}</span></th>
                        <td><b>- NPR {{number_format($order_details->giftcard_amount,2)}}<b></td>
                    </tr>
                    @endif 
                    <tr>
                        <th>Payment method:</th>
                        <td><b><?php if($order_details->payment_method == 'cod'){
                        echo 'Cash On Delivery';
                    }
                    elseif($order_details->payment_method == 'bank_transfer'){
                        echo 'Direct Bank Transfer';
                    }
                    elseif($order_details->payment_method == 'esewa'){
                        echo 'E-Sewa';
                    }
                    elseif($order_details->payment_method == 'khalti'){
                        echo 'Khalti';
                    }
                    elseif($order_details->payment_method == 'connect_ips'){
                        echo 'Connect IPS';
                    }
                    ?></b></td>
                    </tr>
                    <tr>
                        <th>Total:</th>
                        <td><b>NPR {{number_format($order_details->total_amount,2)}}</b></td>
                    </tr>
                    <!--<tr>-->
                        <!--<th>Create Invoice:</th>-->
                        <!--<td><b><a href={{route('order.createInvoice',['order_id'=>$order_id])}} >Create Invoice</a></b></td>-->
                    <!--</tr>-->
                </tfoot>
            </table>
            </div>
        </div>
        </div>
</section>


 <!-- Feedback modal-->
        <div class="modal fade" id="feedbackModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: none;" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Leave a Feedback</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="review_form">
            @csrf
                        <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            
            <div class="form-group">
                <label>Company Name</label>
                <input type="text" name="company_name" class="form-control">
            </div>
            
            <div class="form-group">
                <label>Reveiw</label>
                <textarea name="review" cols="10" rows="5" class="form-control" required></textarea>
            </div>
            
            <div class="form-group">
                <label>Upload Image</label><br>
                <input type="file" name="image">
            </div>
            <hr>
            <div class="form-group text-center review_submit_div">
            <button type="submit" class="btn btn-primary" name="leave_feedback">Submit</button>
            <div class="gif_ajax_loadr" style="display: none;">
                <img src="{{url('public\img\Reload-1s-200px.gif')}}" height="50" width="50"></div>
            </div>
            <div class="testi_msg text-center"></div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection