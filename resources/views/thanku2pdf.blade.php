<!--////////////////////////////////////////-->
<style>
    
    /*
	 CSS-Tricks Example
	 by Chris Coyier
	 http://css-tricks.com
*/

* { margin: 0; padding: 0; }
body { font: 14px/1.4 Georgia, serif; }
#page-wrap { width: 800px; margin: 0 auto; }

textarea { border: 0; font: 14px Georgia, Serif; overflow: hidden; resize: none; }
table { border-collapse: collapse; }
table td, table th { border: 1px solid black; padding: 5px; }

#header { height: 15px; width: 100%; margin: 20px 0; background: #222; text-align: center; color: white; font: bold 15px Helvetica, Sans-Serif; text-decoration: uppercase; letter-spacing: 20px; padding: 8px 0px; }

#address { width: 250px; height: 150px; float: left; }
#customer { overflow: hidden; }

#logo { text-align: right; float: right; position: relative; margin-top: 25px; border: 1px solid #fff; max-width: 540px; max-height: 100px; overflow: hidden; }
#logo:hover, #logo.edit { border: 1px solid #000; margin-top: 0px; max-height: 125px; }
#logoctr { display: none; }
#logo:hover #logoctr, #logo.edit #logoctr { display: block; text-align: right; line-height: 25px; background: #eee; padding: 0 5px; }
#logohelp { text-align: left; display: none; font-style: italic; padding: 10px 5px;}
#logohelp input { margin-bottom: 5px; }
.edit #logohelp { display: block; }
.edit #save-logo, .edit #cancel-logo { display: inline; }
.edit #image, #save-logo, #cancel-logo, .edit #change-logo, .edit #delete-logo { display: none; }
#customer-title { font-size: 20px; font-weight: bold; float: left; }

#meta { margin-top: 1px; width: 300px; float: right; }
#meta td { text-align: right;  }
#meta td.meta-head { text-align: left; background: #eee; }
#meta td textarea { width: 100%; height: 20px; text-align: right; }

#items { clear: both; width: 100%; margin: 30px 0 0 0; border: 1px solid black; }
#items th { background: #eee; }
#items textarea { width: 80px; height: 50px; }
#items tr.item-row td { border: 0; vertical-align: top; }
#items td.description { width: 300px; }
#items td.item-name { width: 175px; }
#items td.description textarea, #items td.item-name textarea { width: 100%; }
#items td.total-line { border-right: 0; text-align: right; }
#items td.total-value { border-left: 0; padding: 10px; }
#items td.total-value textarea { height: 20px; background: none; }
#items td.balance { background: #eee; }
#items td.blank { border: 0; }

#terms { text-align: center; margin: 20px 0 0 0; }
#terms h5 { text-transform: uppercase; font: 13px Helvetica, Sans-Serif; letter-spacing: 10px; border-bottom: 1px solid black; padding: 0 0 8px 0; margin: 0 0 8px 0; }
#terms textarea { width: 100%; text-align: center;}

textarea:hover, textarea:focus, #items td.total-value textarea:hover, #items td.total-value textarea:focus, .delete:hover { background-color:#EEFF88; }

.delete-wpr { position: relative; }
.delete { display: block; color: #000; text-decoration: none; position: absolute; background: #EEEEEE; font-weight: bold; padding: 0px 3px; border: 1px solid; top: -6px; left: -22px; font-family: Verdana; font-size: 12px; }
    
</style>
<!--////////////////////////////////////////-->
<!DOCTYPE html>
<html lang="en">


<?php
    $billingAddress ='';
    
if(auth()->check()){
    $user_id = auth()->user()->id;
    
    //billing address by user id
$billingAddress = billingAddressByUserId($user_id);
}else{
    $user_id ='';
    
//billing address by order id
$billingAddress = billingAddressByOrderId($order_id);
}





 $subtotal = 0;
$order_id = $_GET['order_id'] ?? '';
$order_details = getOrderById($order_id);
$order_items = orderItemsById($order_id);
// print_r($order_details);


//  die();




?>


<head>
	<meta charset='UTF-8'>
	
	<title>Order Invoice</title>
	
	<!--<link rel='stylesheet' href='css/style.css'>-->
	<!--<link rel='stylesheet' href='css/print.css' media="print">-->
	<!--<script src='js/jquery-1.3.2.min.js'></script>-->
	<!--<script src='js/example.js'></script>-->

</head>

<body >

	<div id="page-wrap">

		<textarea id="header">INVOICE</textarea>
		
		<div id="identity">
   <div style="margin-left:5%">
			<img src="{{public_path('/img/').SiteSettingByName('site_logo')}}" width="20%" />

		</div>
				<!-- <img src="{{url(Config::get('constants.SITE_IMAGE_PATHS').SiteSettingByName('site_logo'))}}" alt=""> -->
		<!-- <img src="{{url(Config::get('constants.SITE_IMAGE_PATHS').SiteSettingByName('site_logo'))}}" alt=""> -->
            <textarea id="address">
            	{{SiteSettingByName('site_name')}} 
                Phone: {{SiteSettingByName('call_number')}} 
                Email: {{SiteSettingByName('site_email')}} 
            </textarea>

            <div style="margin-left:50%">
             <p><strong>Order Number:</strong> <strong>{{$order_id}}</strong></p>
              <h6>Date:<strong>{{date('F j, Y',strtotime($order_details->created_at))}}</strong></h6>
             
              <h6>Payment Status:<strong>{{orderStausByKey($order_details->order_status)}}</strong></h6>
                <?php    $phone = ''; ?>
                <?php $phone =   $billingAddress->phone ?? ''; ?>
                  <h6>Phone:
                  <strong>
                  <?php 
                  if(!empty($phone)){
                  echo $phone;
                  } ?>
                </strong></h6>
                
                   
                
                
                
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
                
                <?php
                $fname = '';
                $lname ='';
                $full_name = '';
                 
                $address1= '';
                $address2= '';
                $city= '';
                $state= '';
                $country = '';
             
                ?>
                     <h6>Name:</h6>
                 
                   <p><strong>
                        <?php
                              $fname = $billingAddress->first_name ?? '';
                              $lname = $billingAddress->last_name ?? '';
                              $full_name = '';
                              echo $full_name = $fname.' '.$lname;
                         ?>   
                           </strong></p>
                           
                           
                           
                            <h6>Address:</h6>
                                
                        <?php
                              $country = $billingAddress->country ?? '';
                              $address1 = $billingAddress->address1 ?? '';
                              $address2 = $billingAddress->address2 ?? '';
                               $city = $billingAddress->city ?? '';
                                $state = $billingAddress->state ?? '';
                                 $zipcode = $billingAddress->zipcode ?? '';
                              ?>
                              
                              <!--<h6>Phone No:</h6>-->
                                
                        <?php 
                                //  $phone = $billingAddress->phone ?? '';
                                //   $order_status = $billingAddress->order_status ?? '';
                              ?>
                              <div style="margin-left:63%">
                                <?php echo $address1; ?>
                   <?php echo $address2.'<br/>'; ?>
                
                    <?php echo $city.'<br/>'.$state.'<br/>'.$country; ?>
                              </div>
                              <div>
                                 
                   
              
                     
                   </div> 
                   <!--<div>  <php echo $phone; ?> </div>-->
                   <!--<div>  <php echo $order_status; ?> </div>-->
                          
</div>


            <!-- <div id="logo"> -->

              <!--<div id="logoctr">-->
              <!--<img src="https://bvmprojects.org/custom_pc/public/img/1667890373.png" alt="">-->
              <!--</div>-->

              <!--<div id="logohelp">-->
              <!--  <input id="imageloc" type="text" size="50" value="" /><br />-->
              <!--  (max width: 540px, max height: 100px)-->
              <!--</div>-->
              <!--<img id="image" src="images/logo.png" alt="logo" />-->
            <!-- </div> -->
		
		</div>
		
		<div style="clear:both"></div>
		
		<!--<div id="customer">-->

<!--            <textarea id="customer-title">Widget Corp.-->
<!--c/o Steve Widget</textarea>-->

            <!--<table id="meta">-->
            <!--    <tr>-->
            <!--        <td class="meta-head">Invoice #</td>-->
            <!--        <td><textarea>000123</textarea></td>-->
            <!--    </tr>-->
            <!--    <tr>-->

            <!--        <td class="meta-head">Date</td>-->
            <!--        <td><textarea id="date">December 15, 2009</textarea></td>-->
            <!--    </tr>-->
            <!--    <tr>-->
            <!--        <td class="meta-head">Amount Due</td>-->
            <!--        <td><div class="due">$875.00</div></td>-->
            <!--    </tr>-->

            <!--</table>-->
		
		<!--</div>-->
		
		<table id="items">
		
		  <tr>
		       <th>S.No.</th>
		      <th>Item</th>
		      <th>Unit Cost</th>
		      <th>QTY</th>
		      
		      <th>Price</th>
		  </tr>
		  
		  
		  
	 
		  <?php
		  $i = 1;
		  
		    foreach($order_items as $item){
		        $product_id = $item->product_id;
                    $prod_detail = productDetailById($product_id);
            
                    $subtotal+=$item->price*$item->quantity; 
                    
                    
                    ?>
                     <tr class="item-row">
                          <td class="item-name"><div class="delete-wpr"><textarea>{{$i}}</textarea></div></td>
		                 
		                 <td class="item-name"><div class="delete-wpr">
		                 	@if($product_id == 0 || $product_id == '0' )
		                 	<textarea>Gift Card</textarea>
		                 	@else
							<textarea>{{$prod_detail->title ?? ''}}</textarea>
		                 	@endif
		             </div></td>
		                  <td>NPR {{ $item->price }}</td>
		  		          <td> {{$item->quantity}}</td>
		                  <td>NPR {{number_format($item->price*$item->quantity,2)}}</td>
		              </tr>
	        	  
		
	
		  
		  <?php
		  $i++;
                    
                    }
                    
                    
                    
		  ?>
		 
		       <!--<php  if(!empty($order_details->coupon_code)) {  ?>  -->
         <!--           <php $coupon_detail = coupondetailByCode($order_details->coupon_code); ?>-->
         <!--           <tr> -->
		       <!--          <td class="item-name"><div class="delete-wpr"><textarea>Coupon Code</textarea></div></td>-->
		       <!--           <td> </td>-->
		  		   <!--       <td>  </td>-->
		       <!--           <td><b>- NPR {{number_format($order_details->discount_amount,2)}}<b></td>-->
                        
                        
         <!--           </tr>-->
         <!--             <php } ?>-->
                   
         <!--          <php if(($order_details->giftcard_code)){   ?>        -->
         <!--                  <tr>-->
         <!--                   <td class="item-name"><div class="delete-wpr"><textarea>{{$i}}</textarea></div></td>-->
		       <!--          <td class="item-name"><div class="delete-wpr"><textarea>Gift Card Code</textarea></div></td>-->
		       <!--           <td> </td>-->
		  		   <!--       <td>  </td>-->
		       <!--           <td><b>- NPR {{number_format($order_details->giftcard_amount,2)}}<b></td>-->
                        
         <!--                </tr>-->
                   
         <!--           <php } ?>-->
		  
		  <!--<tr class="item-row">-->
		  <!--    <td class="item-name"><div class="delete-wpr"><textarea>SSL Renewals</textarea><a class="delete" href="javascript:;" title="Remove row">X</a></div></td>-->

		  <!--    <td class="description"><textarea>Yearly renewals of SSL certificates on main domain and several subdomains</textarea></td>-->
		  <!--    <td><textarea class="cost">$75.00</textarea></td>-->
		  <!--    <td><textarea class="qty">3</textarea></td>-->
		  <!--    <td><span class="price">$225.00</span></td>-->
		  <!--</tr>-->
		  
		  <!--<tr id="hiderow">-->
		  <!--  <td colspan="5"><a id="addrow" href="javascript:;" title="Add a row">Add a row</a></td>-->
		  <!--</tr>-->
		   
		   
		    <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Subtotal</td>
		      <td class="total-value"><div id="subtotal"> NPR {{number_format($subtotal,2)}}</div></td>
		  </tr>
		  
		  <?php if(($order_details->coupon_code)){   ?>   
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Discount Coupon Code</td>
		      <td class="total-value"><div id="subtotal">- NPR {{number_format($order_details->discount_amount,2)}}</div></td>
		  </tr>
		  <tr>
		      <?php } ?>
		  <?php if(($order_details->giftcard_code)){   ?>   
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line">Discount Gift Card</td>
		      <td class="total-value"><div id="subtotal">- NPR {{number_format($order_details->giftcard_amount,2)}}</div></td>
		  </tr>
		  
		      <?php } ?>
    <!--        <tr>-->
		  <!--    <td colspan="2" class="blank"> </td>-->
		  <!--    <td colspan="2" class="total-line">Total</td>-->
		  <!--    <td class="total-value"><div id="total">$875.00</div></td>-->
		  <!--</tr>-->
		  <!--<tr>-->
		  <!--    <td colspan="2" class="blank"> </td>-->
		  <!--    <td colspan="2" class="total-line">Amount Paid</td>-->

		  <!--    <td class="total-value"><textarea id="paid">$0.00</textarea></td>-->
		  <!--</tr>-->
		  <tr>
		      <td colspan="2" class="blank"> </td>
		      <td colspan="2" class="total-line balance">Balance Due</td>
		      <td class="total-value balance"><div class="due">NPR {{number_format($order_details->total_amount,2)}}</div></td>
		  </tr>
		
		</table>
		
		<div id="terms">
		  <h5>Terms</h5>
		  <!--<textarea><php '---'.print_r($order_id).'---'; ?></textarea>-->
		</div>
	
	</div>
	
</body>

</html>