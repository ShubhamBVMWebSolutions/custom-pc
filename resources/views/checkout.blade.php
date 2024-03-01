@extends('front-layout.master_layout')
@section('title','Checkout')
@section('content')

<?php $user_id = auth()->id();
$userdetails = getUserDetailsById($user_id);
$subtottal = 0;

if(empty($user_id)){
    $cart = session()->get('cart');
    $pc_cart = session()->get('pc_cart');
} else{
    $cart = $CartSession;
    $pc_cart = session()->get('pc_cart');
}
$pcbuilder_total = 0;
?>


<?php if(isset($_GET['khalti']) && isset($_GET['order_id'])){
    // header("location: ".url('/payment/verification?order_id='.$_GET['order_id']));
    $redirectURL =  url('/payment/verification?order_id='.$_GET['order_id']);
    echo '<script>window.location = "'.$redirectURL.'";</script>';
?>

    <script>

    </script>
<?php } ?>

<!-- Checkout Section Begin -->
<section class="checkout spad">
    <div class="container">
        <div class="checkout__form">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="cart_title">Checkout</h2>
                </div>
            </div>
            <?php if(!empty($cart) || !empty($pc_cart)){ ?>
                @if(empty($user_id))
                <div class="row checkout_login_row">
                    <?php if(session()->has('alert-error')){ ?>
                    <div class="col-md-12 alert alert-danger">
                        <p>{{session()->get('alert-error')}}</p>
                        </div>
                    <?php } ?>
                    <div class="col-md-12">
                        <p class="check_login_p"><i class="fa fa-square-o" aria-hidden="true"></i> Already customer? <a href="{{route('login')}}">Click here to login</a></p>
                    </div>
                </div>
                @endif
                <form action="{{route('create.order')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <h6 class="checkout__title">Billing Details</h6>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Fist Name<span>*</span></p>
                                        <input type="text" name="first_name" value="{{$userdetails->first_name ?? ''}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text" name="last_name" value="{{$userdetails->last_name ?? ''}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="tel" name="phone" pattern="[0-9]{10}" value="{{$billingaddress->phone ?? ''}}" placeholder="Enter 10 digit mobile number" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Email<span>*</span></p>
                                        <input type="email" name="email" value="{{$userdetails->email ?? ''}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="country" value="{{$billingaddress->country ?? ''}}" required>
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" placeholder="Street Address" name="address1" value="{{$billingaddress->address1 ?? ''}}" class="checkout__input__add" required>
                                <input type="text" name="address2" value="{{$billingaddress->address2 ?? ''}}" placeholder="Apartment, suite, unite ect (optional)">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="city" value="{{$billingaddress->city ?? ''}}" required>
                            </div>
                            <div class="checkout__input">
                                <p>State<span>*</span></p>
                                <input type="text" name="state" value="{{$billingaddress->state ?? ''}}" required>
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="zipcode" value="{{$billingaddress->zipcode ?? ''}}" required>
                            </div>
                            @if(empty($user_id))
                            <div class="checkout__input__checkbox">
                                <label for="acc">
                                    Create an account?
                                    <input type="checkbox" id="create_account" name="create_account" value="yes">

                                </label>

                            </div>
                            <div class="checkout__input" id="soi_password_box" style="display: none;">
                                <p>Create an account by entering the information below. If you are a returning customer
                                please login at the top of the page</p>
                                <p>Username<span>*</span></p>
                                <input type="text" name="username" id="username">
                                <p>Account Password<span>*</span></p>
                                <input type="password" name="password" id="password">
                            </div>
                            @endif
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4 class="order__title">Your order</h4>
                                <div class="checkout_scroll">
                                <table class="table checkout_table">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        if(!empty($pc_cart)){

                                $case_prod_id = $pc_cart['case']['product_id'];
                                $case_prod_detail = productDetailById($case_prod_id);
                                $case_color_detail = clorDetailById($pc_cart['case']['color_id']);

                                $cpu_prod_id = $pc_cart['cpu']['product_id'];
                                $cpu_prod_detail = productDetailById($cpu_prod_id);
                                $cpu_color_detail = clorDetailById($pc_cart['cpu']['color_id']);

                                $gpu_prod_id = $pc_cart['gpu']['product_id'];
                                $gpu_prod_detail = productDetailById($gpu_prod_id);

                                $motherboard_prod_id = $pc_cart['motherboard']['product_id'];
                                $mothrboard_prod_detail = productDetailById($motherboard_prod_id);
                                $motherboard_color_detail = clorDetailById($pc_cart['motherboard']['color_id']);

                                $ram_prod_id = $pc_cart['ram']['product_id'];
                                $ram_prod_detail = productDetailById($ram_prod_id);

                                $storage_prod_id = $pc_cart['storage']['product_id'];
                                $storage_prod_detail = productDetailById($storage_prod_id);

                                $cooling_prod_id = $pc_cart['cooling']['product_id'];
                                $cooling_prod_detail = productDetailById($cooling_prod_id);
                                $cooling_color_detail = clorDetailById($pc_cart['cooling']['color_id']);

                                $supply_prod_id = $pc_cart['supply']['product_id'];
                                $supply_prod_detail = productDetailById($supply_prod_id);
                                $supply_color_detail = clorDetailById($pc_cart['supply']['color_id']);

                                $software_prod_id = $pc_cart['software']['product_id'];
                                $software_prod_detail = productDetailById($software_prod_id);

                                $service_prod_id = $pc_cart['service']['product_id'];
                                $service_prod_detail = productDetailById($service_prod_id);
                                        ?>
                                <tr>
                                    <td><p class="pc_build_cat"><strong>CPU Cooler</strong></p>
                                    <p class="other_cat_title"><?=$cooling_prod_detail->title?> <?=$cooling_color_detail[0]->color_name ?? ''?>
                                    x <?=$pc_cart['cooling']['quantity']?></p>
                                </td>
                                <td>NPR <?=number_format($pc_cart['cooling']['price'],2)?></td>
                                </tr>
                                @if(!empty($service_prod_detail))
                                    <tr>
                                    <td><p class="pc_build_cat"><strong>Service</strong></p>
                                        <p class="other_cat_title"><?=$service_prod_detail->title?> x <?=$pc_cart['service']['quantity']?></p>
                                    </td>
                                    <td>NPR <?=number_format($pc_cart['service']['price'],2)?></td>
                                    </tr>
                                @endif

                                @if(!empty($software_prod_detail))
                                    <tr>
                                        <td><p class="pc_build_cat"><strong>Software</strong></p>
                                            <p class="other_cat_title"><?=$software_prod_detail->title?> x <?=$pc_cart['software']['quantity']?></p>
                                        </td>
                                        <td>NPR <?=number_format($pc_cart['software']['price'],2)?></td>
                                    </tr>
                                @endif
                            <tr>
                                <td><p class="pc_build_cat"><strong>Case</strong></p>
                                    <p class="other_cat_title"><?=$case_prod_detail->title?> <?=$case_color_detail[0]->color_name ?? ''?> x <?=$pc_cart['case']['quantity']?></p>
                                </td>
                                <td>NPR <?=number_format($pc_cart['case']['price'],2)?></td>
                            </tr>
                            <tr>
                                <td>
                                    <p class="pc_build_cat"><strong>CPU</strong></p>
                                    <p class="other_cat_title"><?=$cpu_prod_detail->title?> x <?=$pc_cart['cpu']['quantity']?></p>
                                </td>
                                <td>NPR <?=number_format($pc_cart['cpu']['price'],2)?></td>
                            </tr>
                            <tr>
                                <td><p class="pc_build_cat"><strong>RAM</strong></p>
                                    <p class="other_cat_title"><?=$ram_prod_detail->title?> x <?=$pc_cart['ram']['quantity']?></p>
                                </td>
                                <td>NPR <?=number_format($pc_cart['ram']['price']*$pc_cart['ram']['quantity'],2)?></td>
                            </tr>
                            <tr>
                                <td><p class="pc_build_cat"><strong>GPU</strong></p>
                                    <p class="other_cat_title"><?=$gpu_prod_detail->title?> x <?=$pc_cart['gpu']['quantity']?></p>
                                </td>
                                <td>NPR <?=number_format($pc_cart['gpu']['price'],2)?></td>
                            </tr>
                            <tr>
                                <td><p class="pc_build_cat"><strong>Power Supply</strong></p>
                                    <p class="other_cat_title"><?=$supply_prod_detail->title?> <?=$supply_color_detail[0]->color_name ?? ''?>
                                    x <?=$pc_cart['supply']['quantity']?></p>
                                </td>
                                <td>NPR <?=number_format($pc_cart['supply']['price'],2)?></td>
                            </tr>
                            <tr>
                                <td><p class="pc_build_cat"><strong>SSD</strong></p>
                                    <p class="other_cat_title"><?=$storage_prod_detail->title?> x <?=$pc_cart['storage']['quantity']?></p>
                                </td>
                                <td>NPR <?=number_format($pc_cart['storage']['price']*$pc_cart['storage']['quantity'],2)?></td>
                            </tr>
                            <tr>
                                <td><p class="pc_build_cat"><strong>Motherboard</strong></p>
                                    <p class="other_cat_title"><?=$mothrboard_prod_detail->title?> <?=$motherboard_color_detail[0]->color_name ?? ''?>
                                    x <?=$pc_cart['motherboard']['quantity']?></p>
                                </td>
                                <td>NPR <?=number_format($pc_cart['motherboard']['price'],2)?></td>
                            </tr>

                            <?php if(!empty($pc_cart['rgb']['product_id'])){
                          $rgb_prod_id = $pc_cart['rgb']['product_id'];
                          $rgb_prod_detail = productDetailById($rgb_prod_id);?>
                          <tr>
                                <td><p class="pc_build_cat"><strong>RGB Lighting</strong></p>
                                    <p class="other_cat_title"><?=$rgb_prod_detail->title?> x <?=$pc_cart['rgb']['quantity']?></p>
                                </td>
                                <td>NPR <?=number_format($pc_cart['rgb']['price'],2)?></td>
                            </tr>
                          <?php } ?>

                            <?php if(!empty($pc_cart['monitor']['product_id'])){
                          $monitor_prod_id = $pc_cart['monitor']['product_id'];
                          $monitor_prod_detail = productDetailById($monitor_prod_id);?>
                          <tr>
                                <td><p class="pc_build_cat"><strong>Monitor</strong></p>
                                    <p class="other_cat_title"><?=$monitor_prod_detail->title?> x <?=$pc_cart['rgb']['quantity']?></p>
                                </td>
                                <td>NPR <?=number_format($pc_cart['monitor']['price'],2)?></td>
                            </tr>
                          <?php } ?>

                          <?php if(!empty($pc_cart['peripheral']['product_id'])){
                          $peripheral_prod_id = $pc_cart['peripheral']['product_id'];
                          $peripheral_prod_detail = productDetailById($peripheral_prod_id);?>
                          <tr>
                                <td><p class="pc_build_cat"><strong>Peripheral</strong></p>
                                    <p class="other_cat_title"><?=$peripheral_prod_detail->title?> x <?=$pc_cart['peripheral']['quantity']?></p>
                                </td>
                                <td>NPR <?=number_format($pc_cart['peripheral']['price'],2)?></td>
                            </tr>
                          <?php } ?>

                          <?php if(!empty($pc_cart['extra']['product_id'])){
                          $extra_prod_id = $pc_cart['extra']['product_id'];
                          $extra_prod_detail = productDetailById($extra_prod_id);?>
                            <tr>
                                <td><p class="pc_build_cat"><strong>Peripheral</strong></p>
                                    <p class="other_cat_title"><?=$extra_prod_detail->title?> x <?=$pc_cart['extra']['quantity']?></p>
                                </td>
                                <td>NPR <?=number_format($pc_cart['extra']['price'],2)?></td>
                            </tr>
                          <?php } ?>
                                        <?php $pcbuilder_total = $pc_cart['cooling']['price']+$pc_cart['service']['price']+$pc_cart['software']['price']+
                            $pc_cart['case']['price']+$pc_cart['cpu']['price']+($pc_cart['ram']['price']*$pc_cart['ram']['quantity'])+$pc_cart['gpu']['price']+$pc_cart['supply']['price']+
                            ($pc_cart['storage']['price']*$pc_cart['storage']['quantity'])+$pc_cart['motherboard']['price']+$pc_cart['rgb']['price']+($pc_cart['monitor']['price']*$pc_cart['monitor']['quantity'])+
                            $pc_cart['peripheral']['price']+$pc_cart['extra']['price'];
                                        } ?>
                                        @if(empty($user_id))
                                        <?php $cart = session()->get('cart');
                                        if(!empty($cart)){
                                            foreach($cart as $id => $item){
                                                $item_price = $item['price']*$item['quantity'];

                                                $color_name = '';
                                                $ssd_title = '';
                                                $screen_size_title = '';
                                                $ram_title = '';
                                                $variation_details = getVariationdetailById($item['variation_id']);
                                                if(!empty($variation_details)){
                                                    if(!empty($variation_details->color_id)){
                                                        $color_name =  $variation_details->color_details->color_name;
                                                    }

                                                    if(!empty($variation_details->ssd_id)){
                                                        $ssd_title =  $variation_details->ssd_details->title;
                                                    }

                                                    if(!empty($variation_details->screen_size_id)){
                                                        $screen_size_title =  $variation_details->screen_size_details->title;
                                                    }

                                                    if(!empty($variation_details->ram_id)){
                                                        $ram_title =  $variation_details->ram_details->title;
                                                    }

                                                    if(!empty($variation_details->price)){
                                                        $item_price = $variation_details->price*$item['quantity'];
                                                    }
                                                }
                                                $subtottal+=$item_price;

                                                ?>
                                                <?php if($item['product_type'] == 'giftcard'){
                                                    $id = $item['product_id'];
                                                }else{
                                                    $id = $id;
                                                }

                                                ?>
                                                <input type="hidden" name="product_id[]" value="{{$id}}">

                                                <input type="hidden" name="quantity[]" value="{{$item['quantity']}}">
                                                <input type="hidden" name="price[]" value="{{$item_price}}">
                                                <input type="hidden" name="variation_id[]" value="{{$item['variation_id']}}">
                                                <tr>
                                                    <td>{{$item['name']}} X {{$item['quantity']}}
                                                    @if(!empty($variation_details))
                                                    <div>
                                                        <p>
                                                            @if($color_name)
                                                            Color:  {{$color_name}}
                                                            @endif

                                                            @if($ssd_title)
                                                            SSD:  {{$ssd_title}}
                                                            @endif

                                                            @if($screen_size_title)
                                                            Screen size:  {{$screen_size_title}}
                                                            @endif

                                                            @if($ram_title)
                                                            RAM:  {{$ram_title}}
                                                            @endif

                                                        </p>
                                                    </div>
                                                    @endif
                                                    </td>
                                                    <td>NPR {{number_format($item_price,2)}}</td>
                                                </tr>
                                            <?php } }

                                         ?>
                                            @else
                                            <?php $cart = $CartSession;
                                            foreach($cart as $item){
                                                $prod_id = $item->product_id;
                                                $prod_detail = productDetailById($prod_id);
                                                $item_price = $item->price*$item->quantity;

                                                $variation_details = getVariationdetailById($item->variation_id);
                                                $color_name = '';
                                                $ssd_title = '';
                                                $screen_size_title = '';
                                                $ram_title = '';
                                                if(!empty($variation_details)){
                                                    if(!empty($variation_details->color_id)){
                                                        $color_name =  $variation_details->color_details->color_name;
                                                    }

                                                    if(!empty($variation_details->ssd_id)){
                                                        $ssd_title =  $variation_details->ssd_details->title;
                                                    }

                                                    if(!empty($variation_details->screen_size_id)){
                                                        $screen_size_title =  $variation_details->screen_size_details->title;
                                                    }

                                                    if(!empty($variation_details->ram_id)){
                                                        $ram_title =  $variation_details->ram_details->title;
                                                    }

                                                    if(!empty($variation_details->price)){
                                                        $item_price = $variation_details->price*$item->quantity;
                                                    }
                                                }
                                                $subtottal+=$item_price;
                                                ?>
                                                <input type="hidden" name="product_id[]" value="{{$prod_id}}">
                                                <input type="hidden" name="quantity[]" value="{{$item->quantity}}">
                                                <input type="hidden" name="price[]" value="{{$item_price}}">
                                                <input type="hidden" name="variation_id[]" value="{{$item->variation_id}}">
                                                <tr>
                                                    <td>



<!-- //////////////Giftcard else condition put/// -->
                                                    @if($prod_id  == 0)
                                                    Gift Card X 1
                                                    @else
                                                    {{$prod_detail->title}} X {{$item->quantity}}
                                                    @endif
<!-- //////////////Giftcard/// -->
                                                    @if(!empty($variation_details))
                                                    <div>
                                                        <p>
                                                            @if($color_name)
                                                            Color:  {{$color_name}}
                                                            @endif

                                                            @if($ssd_title)
                                                            SSD:  {{$ssd_title}}
                                                            @endif

                                                            @if($screen_size_title)
                                                            Screen size:  {{$screen_size_title}}
                                                            @endif

                                                            @if($ram_title)
                                                            RAM:  {{$ram_title}}
                                                            @endif

                                                        </p>
                                                    </div>
                                                    @endif
                                                    </td>
                                                    <td>NPR {{number_format($item_price,2)}}</td>
                                                </tr>
                                            <?php } ?>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>

                                    <?php $discount = 0;
                                    $coupon_code = '';
                                    if(session()->has('applied_coupon')){
                                        $coupon_arr = session()->get('applied_coupon');

                                        $coupon_code = $coupon_arr['coupon_code'];
                                        $coupon_detail = coupondetailByCode($coupon_arr['coupon_code']);
                                        $used = $coupon_detail->used;
                                        $use_limit = $coupon_detail->use_limit;
                                        if($use_limit >= $used){
                                        if($coupon_detail->discount_type == 'amount'){
                                            $discount = $coupon_detail->coupon_amount;

                                        }

                                        if($coupon_detail->discount_type == 'percent'){
                                         $discount = ($subtottal*$coupon_detail->coupon_amount)/100;
                                          }
                                        }
                                 }

                                 $subtottal = $subtottal+$pcbuilder_total;
                                 ?>

                                 <ul class="checkout__total__all">
                                    <li>Subtotal <span>NPR {{number_format($subtottal,2)}}</span></li>
                                    @if(!empty($discount))
                                    <li>Coupon: {{$coupon_arr['coupon_code']}} <span>- NPR {{number_format($discount,2)}}</span></li>
                                    @endif
                                    <li style="dispaly:none" class="applygiftcard"></li>
                                    <li class="total_amount">Total <span>NPR {{number_format($subtottal-$discount,2)}}</span></li>
                                </ul>

                                <div class="checkout_payment_methods">
                                    <h3>Payment Methods</h3>
                                    @if($payment_methods->count() > 0)
                                    @foreach($payment_methods as $method)
                                    <div class="checkout__input__checkbox">
                                        <label>
                                            <input type="radio" name="payment_method" value="{{$method->value}}" id="payment" required>
                                            <img src="{{asset('img/'.$method->image)}}" class="method_imgs">

                                        </label>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>

                                <input type="hidden" name="coupon_code" value="{{$coupon_code}}">
                                <input type="hidden" name="total_amount" value="{{$subtottal-$discount}}">
                                <input type="hidden" name="discount_amount" value="{{$discount}}">
                                <input type="hidden" name="biiling_address_id" value="{{billingdetailById($user_id)->id ?? ''}}">
                                <?php if(isset($_GET['khalti']) && isset($_GET['order_id'])){ ?>
                                    <a href="{{url('/checkout/?khalti=pay&order_id='.$_GET['order_id'])}}" class="primary-btn checkout-btn text-center">PLACE ORDER</a>
                                <?php } else{?>
                                    <button type="submit" class="primary-btn checkout-btn">PLACE ORDER</button>
                                <?php } ?>
                            </div>


                            <!--  Gift card section Start-->
                            <div class="checkout__order mt-3 giftcard_section">
                              <h4 class="order__title">Gift Card</h4>
                              <div class="row">
                                    <div class="col-7">
                                        <input type="text" class="form-control giftcode" value="" name="giftcardCode" placeholder="Gift card number">

                                    </div>
                                    <div class="col-5 pl-0">
                                        <div class="d-flex">
                                             <input type="text" class="form-control giftpin" value="" name="giftPin" placeholder="pin">
                                             <button type="button" class="btn primary-btn giftcard-button" style="padding: 7px 10px;">Apply</button>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                    <span class="text-danger giftcode-error"></span>
                                    <span class="text-success giftcode-success"></span>
                                    </div>
                                 </div>
                            </div>
                            <!--  Gift card section End-->
                 </div>
             </div>
         </form>
     <?php } else{ ?>
        <div class="row">
            <div class="col-md-12 empty_cart_div">
                <h4 class="empty_cart_h2">There are no items in your cart</h4>
                <a class="primary-btn" href="{{route('home')}}">Continue Shopping</a>
            </div>
        </div>
    <?php } ?>
</div>
</div>
</section>
<!-- Checkout Section End -->

@endsection
@push('custom-scripts')
<script type="text/javascript">



$(".giftcard-button").click(function(event){
      event.preventDefault();

        var giftCode = $('.giftcode').val();
        var giftPin = $('.giftpin').val();
        if(giftCode == '' || giftPin == ''){
            $('.giftcode-error').empty();
            $('.giftcode-error').html('Gift card number and Pin required');
        }else{
            $.ajax({
            url: "{{Route('apply-giftcard')}}",
            type: "POST",
            data: {giftCode:giftCode,
                  giftPin:giftPin,
                 _token:"{{csrf_token()}}"
                },
            dataType:"json",
            success:function(result){
                console.log(result);
                if(result.error){
                    $('.form-control.giftcode').val('');
                    $('.form-control.giftpin').val('');
                    $('.applygiftcard').empty()
                    $('.giftcode-error').empty();
                    $('.giftcode-error').html(result.error);
                    return false;
                }
                if(result.success){
                    $('.applygiftcard').empty();
                    $('.applygiftcard').html('Gift card <span>- NPR '+result.usedAmount +' </span>');
                    $('.applygiftcard').show();
                    $('.total_amount').empty();
                    $('.total_amount').html('Total <span>NPR '+result.total +'</span>');
                    $('.giftcode-success').empty();
                    $('.giftcode-success').html(result.success);
                    $('.giftcode-error').html('');
                    $('.giftcard-button').attr('disabled', 'disabled');


                }
            }
            });
        }


    //   $(".giftcard-button").click(function(event){
    //   event.preventDefault();

    //     var giftCode = $('.giftcode').val();
    //     var giftPin = $('.giftpin').val();
    //     if(giftCode == '' || giftPin == ''){
    //         $('.giftcode-error').empty();
    //         $('.giftcode-error').html('Gift card number and Pin requride');

    //     }


    //         $.ajax({
    //         url: "{{Route('apply-giftcard')}}",
    //         type: "POST",
    //         data: {giftCode:giftCode,
    //               giftPin:giftPin,
    //              _token:"{{csrf_token()}}"
    //             },
    //         dataType:"json",
    //         success:function(result){
    //             if(result.error){
    //                  $('.applygiftcard').empty()
    //                 $('.giftcode-error').empty();
    //                 $('.giftcode-error').html(result.error);
    //                 return false;
    //             }
    //             if(result.success){

    //                 $('.applygiftcard').empty();
    //                 $('.applygiftcard').html('Gift card <span>- NPR '+result.usedAmount +' </span>');
    //                  $('.applygiftcard').show();
    //                   $('.total_amount').empty();
    //                 $('.total_amount').html('Total <span>NPR '+result.total +'</span>');
    //                 $('.giftcode-success').empty();
    //                 $('.giftcode-success').html(result.success);
    //                 $('.giftcard-button').attr('disabled', 'disabled');

    //             }
    //         }
    //     });




    });
</script>
@endpush
