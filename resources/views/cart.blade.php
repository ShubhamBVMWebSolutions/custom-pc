@extends('front-layout.master_layout')
@section('title','Cart')
@section('content')

<?php use App\Models\Coupon;
$user_id = auth()->id();
$cart = array();

if(empty($user_id)){
$cart = session()->get('cart'); 
$pc_cart = session()->get('pc_cart');
} else{
$cart = $CartSession;
$pc_cart = session()->get('pc_cart');
}

$subtottal = 0;
//print_r($cart);

?>

<!-- Shopping Cart Section Begin -->
<section class="shopping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="cart_title">My Cart</h2>
            </div>    
        </div>
        @if(empty($cart) && empty($pc_cart))
        <div class="row">
            <div class="col-md-12 empty_cart_div">
                <h2 class="empty_cart_h2">There are no any items in your cart</h2>
                <a class="primary-btn" href="{{route('home')}}">Continue Shopping</a>
            </div>
        </div>
        @else
        <div class="row">
            <div class="col-lg-8">
                <div class="shopping__cart__table">
                
                    <table>
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(!empty($pc_cart)){ 
                                $case_prod_id = $pc_cart['case']['product_id'];
                                $case_prod_detail = productDetailById($case_prod_id);
                                $case_color_detail = clorDetailById($pc_cart['case']['color_id']);
                                
                                $cpu_prod_id = $pc_cart['cpu']['product_id'];
                                $cpu_prod_detail = productDetailById($cpu_prod_id);
                                
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
                                <td>
                                    <div class="case_prod_img">
                                        <?php if(!empty($pc_cart['case']['variation_id'])){ 
                                            $case_variation_img = getVariationImageById($pc_cart['case']['variation_id'])[0]->variation_image;
                                        ?>
                                        <img src="<?=url(Config::get('constants.SITE_PRODUCT_IMAGE').$case_variation_img)?>">
                                        <?php } else{?>
                                        <img src="<?=url(Config::get('constants.SITE_PRODUCT_IMAGE').$case_prod_detail->image)?>">
                                        <?php } ?>
                                    </div>
                                    <h2 class="case_title"><?=$case_prod_detail->title?> <?=$case_color_detail[0]->color_name ?? ''?> Build</h2>
                                </td>
                                <td></td>
                                <td>
                                    <td class="cart__close">
                                    <button class="btn btn-danger btn-sm remove-pc-cart" id="remove_pc_cart">
                                    <i class="fa fa-close"></i> <span>Remove</span>
                                    </button>
                                    </td>
                                </td>
                            </tr>
                            
                            <tr>
                                <td><h5 class="pc_build_cat"><strong>CPU Cooler</strong></h5>
                                    <h6 class="other_cat_title"><?=$cooling_prod_detail->title?> <?=$cooling_color_detail[0]->color_name ?? ''?></h6>
                                </td>
                                <td><?=$pc_cart['cooling']['quantity']?></td>
                                <td>NPR <?=number_format($pc_cart['cooling']['price'],2)?></td>
                            </tr>
                            @if(!empty($service_prod_detail))
                            <tr>
                                <td><h5 class="pc_build_cat"><strong>Service</strong></h5>
                                    <h6 class="other_cat_title"><?=$service_prod_detail->title?></h6>
                                </td>
                                <td><?=$pc_cart['service']['quantity']?></td>
                                <td>NPR <?=number_format($pc_cart['service']['price'],2)?></td>
                            </tr>
                            @endif
                            @if(!empty($software_prod_detail))
                            <tr>
                                <td><h5 class="pc_build_cat"><strong>Software</strong></h5>
                                    <h6 class="other_cat_title"><?=$software_prod_detail->title?></h6>
                                </td>
                                <td><?=$pc_cart['software']['quantity']?></td>
                                <td>NPR <?=number_format($pc_cart['software']['price'],2)?></td>
                            </tr>
                            
                            @endif
                            <tr>
                                <td><h5 class="pc_build_cat"><strong>Case</strong></h5>
                                    <h6 class="other_cat_title"><?=$case_prod_detail->title?> <?=$color_detail[0]->color_name ?? ''?></h6>
                                </td>
                                <td><?=$pc_cart['case']['quantity']?></td>
                                <td>NPR <?=number_format($pc_cart['case']['price'],2)?></td>
                            </tr>
                            <tr>
                                <td>
                                    <h5 class="pc_build_cat"><strong>CPU</strong></h5>
                                    <h6 class="other_cat_title"><?=$cpu_prod_detail->title?></h6>
                                </td>
                                <td><?=$pc_cart['cpu']['quantity']?></td>
                                <td>NPR <?=number_format($pc_cart['cpu']['price'],2)?></td>
                            </tr>
                              <tr>
                                <td><h5 class="pc_build_cat"><strong>RAM</strong></h5>
                                    <h6 class="other_cat_title"><?=$ram_prod_detail->title?></h6>
                                </td>
                                <td><?=$pc_cart['ram']['quantity']?></td>
                                <td>NPR <?=number_format($pc_cart['ram']['price']*$pc_cart['ram']['quantity'],2)?></td>
                            </tr>
                            <tr>
                                <td><h5 class="pc_build_cat"><strong>GPU</strong></h5>
                                    <h6 class="other_cat_title"><?=$gpu_prod_detail->title?></h6>
                                </td>
                                <td><?=$pc_cart['gpu']['quantity']?></td>
                                <td>NPR <?=number_format($pc_cart['gpu']['price'],2)?></td>
                            </tr>
                            <tr>
                                <td><h5 class="pc_build_cat"><strong>Power Supply</strong></h5>
                                    <h6 class="other_cat_title"><?=$supply_prod_detail->title?> <?=$supply_color_detail[0]->color_name ?? ''?></h6>
                                </td>
                                <td><?=$pc_cart['supply']['quantity']?></td>
                                <td>NPR <?=number_format($pc_cart['supply']['price'],2)?></td>
                            </tr>
                            <tr>
                                <td><h5 class="pc_build_cat"><strong>SSD</strong></h5>
                                    <h6 class="other_cat_title"><?=$storage_prod_detail->title?></h6>
                                </td>
                                <td><?=$pc_cart['storage']['quantity']?></td>
                                <td>NPR <?=number_format($pc_cart['storage']['price']*$pc_cart['storage']['quantity'],2)?></td>
                            </tr>
                            <tr>
                                <td><h5 class="pc_build_cat"><strong>Motherboard</strong></h5>
                                    <h6 class="other_cat_title"><?=$mothrboard_prod_detail->title?> <?=$motherboard_color_detail[0]->color_name ?? ''?></h6>
                                </td>
                                <td><?=$pc_cart['motherboard']['quantity']?></td>
                                <td>NPR <?=number_format($pc_cart['motherboard']['price'],2)?></td>
                            </tr>
                          
                          <?php if(!empty($pc_cart['rgb']['product_id'])){ 
                          $rgb_prod_id = $pc_cart['rgb']['product_id'];
                          $rgb_prod_detail = productDetailById($rgb_prod_id);?>
                          <tr>
                                <td><h5 class="pc_build_cat"><strong>RGB Lighting</strong></h5>
                                    <h6 class="other_cat_title"><?=$rgb_prod_detail->title?></h6>
                                </td>
                                <td><?=$pc_cart['rgb']['quantity']?></td>
                                <td>NPR <?=number_format($pc_cart['rgb']['price'],2)?></td>
                            </tr>
                          <?php } ?>
                          
                          <?php if(!empty($pc_cart['monitor']['product_id'])){ 
                          $monitor_prod_id = $pc_cart['monitor']['product_id'];
                          $monitor_prod_detail = productDetailById($monitor_prod_id);?>
                          <tr>
                                <td><h5 class="pc_build_cat"><strong>Monitor</strong></h5>
                                    <h6 class="other_cat_title"><?=$monitor_prod_detail->title?></h6>
                                </td>
                                <td><?=$pc_cart['monitor']['quantity']?></td>
                                <td>NPR <?=number_format($pc_cart['monitor']['price']*$pc_cart['monitor']['quantity'],2)?></td>
                            </tr>
                          <?php } ?>
                          
                          <?php if(!empty($pc_cart['peripheral']['product_id'])){ 
                          $peripheral_prod_id = $pc_cart['peripheral']['product_id'];
                          $peripheral_prod_detail = productDetailById($peripheral_prod_id);?>
                          <tr>
                                <td><h5 class="pc_build_cat"><strong>Peripheral</strong></h5>
                                    <h6 class="other_cat_title"><?=$peripheral_prod_detail->title?></h6>
                                </td>
                                <td><?=$pc_cart['peripheral']['quantity']?></td>
                                <td>NPR <?=number_format($pc_cart['peripheral']['price'],2)?></td>
                            </tr>
                          <?php } ?>
                          
                          <?php if(!empty($pc_cart['extra']['product_id'])){ 
                          $extra_prod_id = $pc_cart['extra']['product_id'];
                          $extra_prod_detail = productDetailById($extra_prod_id);?>
                          <tr>
                                <td><h5 class="pc_build_cat"><strong>Peripheral</strong></h5>
                                    <h6 class="other_cat_title"><?=$extra_prod_detail->title?></h6>
                                </td>
                                <td><?=$pc_cart['extra']['quantity']?></td>
                                <td>NPR <?=number_format($pc_cart['extra']['price'],2)?></td>
                            </tr>
                          <?php } ?>
                            
                            
                            <?php $subtottal = $pc_cart['cooling']['price']+$pc_cart['service']['price']+$pc_cart['software']['price']+
                            $pc_cart['case']['price']+$pc_cart['cpu']['price']+($pc_cart['ram']['price']*$pc_cart['ram']['quantity'])+$pc_cart['gpu']['price']+$pc_cart['supply']['price']+
                            ($pc_cart['storage']['price']*$pc_cart['storage']['quantity'])+$pc_cart['motherboard']['price']+$pc_cart['rgb']['price']+($pc_cart['monitor']['price']*$pc_cart['monitor']['quantity'])+
                            $pc_cart['peripheral']['price']+$pc_cart['extra']['price'];
                            } ?>
                            
                            @if(empty($user_id) && !empty($cart))
                                    @foreach($cart as $id => $item)
                                    <?php $prod_detail = productDetailById($id);
                                    $item_price = $item['price']*$item['quantity'];
                                    
                                    if(isset($item['variation_id'])){
                                        $variation_img = getVariationImageById($item['variation_id']);
                                    }
                                
                                
                                if(isset($item['variation_id'])){
                                    if(!empty($item['variation_id'])){
                                        $image = $variation_img[0]->variation_image;
                                    }
                                    else{
                                        $image = $item['image'];
                                    }
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
                                }
                                $subtottal+=$item_price;
                                    ?>
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">

                                            @if(!empty($variation_details))
                                                <img src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$image )}}" alt="">
                                            @else
                                            @if(!empty($image))
                                            <img src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$image )}}" alt="">
                                            @endif    
                                            @endif
                                            </div>
                                            <div class="product__cart__item__text">
                                            
                                            <h6>{{$item['name']}}</h6>
                                            @if(!empty($variation_details))
                                                <div>
                                                    <small>
                                                        @if($color_name)
                                                        Color:  {{$color_name}}<br> 
                                                        @endif

                                                        @if($ssd_title)
                                                        SSD:  {{$ssd_title}}<br> 
                                                        @endif

                                                        @if($screen_size_title)
                                                        Screen size:  {{$screen_size_title}}<br> 
                                                        @endif

                                                        @if($ram_title)
                                                        RAM:  {{$ram_title}}<br> 
                                                        @endif
                                                        
                                                    </small>
                                                </div>
                                                @endif
                                            </div>
                                        
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                        <!-- ///gift card condition -->
                                            @if($item['product_type'] == 'giftcard')
                                            <div class="pro-qty " style="visibility: hidden;">
                                                <input disabled type="hidden" name="quantity" id="quantity" data-id="{{$id}}" value="{{1}}">
                                            </div>
                                            @else
                                                <div class="pro-qty-2 cart_qty_div">
                                                    <input type="text" name="quantity" max="<?=$prod_detail->stock_qty?>" id="quantity" data-id="{{$id}}" value="{{$item['quantity']}}" readonly>
                                                    </div>    
                                                @endif
                                                <!-- ///gift card condition -->
                                            </div>
                                        </td>
                                        <td class="cart__price">NPR {{number_format($item_price,2)}}</td>
                                        <td class="cart__close">
                                            
                                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}">
                                            <i class="fa fa-close"></i> <span>Remove</span>
                                            </button>


                                        </td>
                                    </tr>
                                    @endforeach
                           @endif
                           
                           @if(!empty($user_id) && !empty($CartSession))
                                @foreach($CartSession as $item)
                              
                           
                                <?php $prod_id = $item->product_id;
                                $prod_detail = productDetailById($prod_id);
                                
                                    $item_price = $item->price*$item->quantity;
                                    
                                    
                                    $variation_img = getVariationImageById($item->variation_id);
                                /////////////////////////////////////////
                                if($prod_id==0){
        /////////////////////////////////////////////////
                                        $image = '1668675541.png';
        ////////////////////////////////////
                                        }else{
                                            if(!empty($item->variation_id)){
                                                $image = $variation_img[0]->variation_image;
                                            }
                                            else{
                                                $image = $prod_detail->image;
                                            }
                                        }
        //////////////////////////////////////////////////////

                                    $color_name = '';
                                    $ssd_title = '';
                                    $screen_size_title = '';
                                    $ram_title = '';
                                    $variation_details = getVariationdetailById($item->variation_id);
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
                                    
                                    <tr>
                                        <td class="product__cart__item">
                                            <div class="product__cart__item__pic">
                                                <?php if(!empty($item->variation_id)){ 
                                                $prdovariationimgs = getVariationImageById($item->variation_id);
                                                ?>
                                                <img src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$prdovariationimgs[0]->variation_image )}}" alt="">
                                                <?php } else{ 
                                                if(!empty($image)){ ?>
                                                <img src="{{url(Config::get('constants.SITE_PRODUCT_IMAGE').$image )}}" alt="">
                                                <?php } }?>
                                            </div>
                                            <div class="product__cart__item__text">

                                                <!-- ////title of sesstion change -->
                                                    @if($prod_id==0)
                                                        <h6>Gift Card</h6>
                                                    @else
                                                        <h6>{{$prod_detail->title}}</h6>
                                                    @endif
                                                    <!-- ////title of sesstion change -->

                                                @if(!empty($variation_details))
                                                <div>
                                                    <small>
                                                        @if($color_name)
                                                        Color:  {{$color_name}}<br>
                                                        @endif

                                                        @if($ssd_title)
                                                        SSD:  {{$ssd_title}}<br> 
                                                        @endif

                                                        @if($screen_size_title)
                                                        Screen size:  {{$screen_size_title}}<br> 
                                                        @endif

                                                        @if($ram_title)
                                                        RAM:  {{$ram_title}}<br> 
                                                        @endif
                                                        
                                                    </small>
                                                </div>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="quantity__item">
                                            <div class="quantity">
                                            <!-- <php   print_r($item->id); ?> -->
                                            <!-- <php   print_r($item->product_type); ?> -->
                                            @if($item->product_type == 'giftcard')
                                               <div class="pro-qty" style="visibility: hidden;">
                                          
                                                    <input disabled type="hidden" name="quantity" id="quantity" data-id="{{ $item->id }}" value="1">
                                                </div>
                                            @else
                                            <div class="pro-qty-2 cart_qty_div">
                                                    <input type="text" name="quantity" max="<?=$prod_detail->stock_qty?>" id="quantity" data-id="{{$prod_id}}" value="{{$item->quantity}}" readonly>
                                                </div>

                                            @endif

                                            </div>
                                        </td>
                                        <td class="cart__price">NPR {{number_format($item_price,2)}}</td>
                                        <td class="cart__close">
                                        @if($item->product_type == 'giftcard')
                                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $item->id }}">
                                            <i class="fa fa-close"></i> <span>Remove</span>
                                            </button>
                                            @else
                                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $prod_id }}">
                                            <i class="fa fa-close"></i> <span>Remove</span>
                                            </button>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                           @endif
                           
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="continue__btn">
                            <a href="{{route('home')}}">Continue Shopping <i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="col-lg-4">
                <div class="cart__discount">
                    <h6>Discount codes</h6>
                    <?php $discount = 0;
                   
                    if(session()->has('applied_coupon')){
                        $coupon_arr = session()->get('applied_coupon');
                         $coupon_code = $coupon_arr['coupon_code'];
                        
                        $coupon_detail = coupondetailByCode($coupon_arr['coupon_code']);
 
                        $used = $coupon_detail->used;
                        $use_limit = $coupon_detail->use_limit;
                        if($use_limit >= $used){
                        if($coupon_detail->discount_type == 'amount'){
                        $discount = $coupon_detail->coupon_amount;
                        Coupon::where('coupon_code','=',$coupon_code)->update(['used'=>$used+1]);
                        }
                        
                        if($coupon_detail->discount_type == 'percent'){
                        $discount = ($subtottal*$coupon_detail->coupon_amount)/100;
                        Coupon::where('coupon_code','=',$coupon_code)->update(['used'=>$used+1]);
                        }
                        }
                    }
                    ?>
                    <form action="#">
                        <input type="text" placeholder="Coupon code" id="coupon_code" value="@if(!empty($discount)) {{$coupon_arr['coupon_code'] ?? ''}} @endif">
                        <button type="button" id="apply_code" value="{{$subtottal}}">Apply</button>
                        
                    </form>
                    <p id="cop_err" style="color: red; margin-top: 10px;"></p>
                </div>
                <div class="cart__total">
                    <h6>Cart total</h6>
                    
                    <ul>
                        <li>Subtotal <span>NPR {{number_format($subtottal,2)}}</span></li>
                        @if(!empty($discount))
                        <li>Coupon: {{$coupon_arr['coupon_code']}} <span>- NPR {{number_format($discount,2)}}</span></li>
                        @endif
                        <li>Total <span id="total_amount"> NPR {{number_format($subtottal-$discount,2)}}</span></li>
                    </ul>
                    <a href="{{route('checkout')}}" class="primary-btn">Proceed to checkout</a>
                </div>
            </div>
        </div>
        
        
        @endif
    </div>
</section>
<!-- Shopping Cart Section End -->

@endsection
