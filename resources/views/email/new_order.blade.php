@include('email.email_header')
<?php $order_id = $data['order_id'];
$orderData = getOrderById($order_id); 
$orderItems = orderItemsById($order_id); 

$subtotal = 0;
$coupn_amount = 0;

$user_id = $orderData->user_id;
?>

<table style="width:100%; border: 1px solid#eee; max-width: 600px; margin: 0 auto;">
    <tbody style="display: block;padding: 30px 0; color: #718096;">
        <tr>
			<td colspan="3" style="display: block;">
				<h1 style="margin:0; font-size: 18px;line-height: 30px;">Thank you for your order</h1>
			</td>
		</tr>
		<tr>
		    <td><p>{{$data['message']}}</p>
		    <h2>Order #{{$order_id}} ({{date('F j, Y', strtotime($orderData->created_at))}})</h2>
		    <table cellspacing="0" cellpadding="6" style="width:100%;font-family:'Helvetica Neue',Helvetica,Roboto,Arial,sans-serif;margin-bottom:40px" border="1">
		        <thead>
		            <tr>
		                <th>Product</th>
		                <th>Quantity</th>
		                <th>Price</th>
		            </tr>
		        </thead>
		        <tbody>
		            @foreach($orderItems as $items)
		            @if(!empty($items))
    		            <?php $itemData = productDetailById($items->product_id); 
                        $subtotal+=$items->price*$items->quantity;
                        ?>
                            @if(!empty($itemData))    
                            <tr>
        		                <td>{{$itemData->title}}
        		                
        		                </td>
        		                <td>{{$items->quantity}}</td>
        		                <td>NPR {{number_format($items->price*$items->quantity,2)}}</td>
        		            </tr>
        		            @endif
                    @endif
		            
		            @endforeach
		        </tbody>
		        <tfoot>
		            <tr>
                    <th scope="row" colspan="2" style="text-align:left;border-top-width:4px">Subtotal:</th>
                    <td>NPR {{number_format($subtotal,2)}}</td>
                </tr>
                @if(!empty($orderData->coupon_code)) 
                <tr>
                    <th scope="row" colspan="2" style="text-align:left;">Applied Coupon: <span>({{$orderData->coupon_code}})</span></th>
                    <td>-NPR {{$orderData->discount_amount}}</td>
                </tr>
                @endif
                <tr>
                    <th scope="row" colspan="2" style="text-align:left;">Payment Method:</th>
                    <td>{{$orderData->payment_method}}</td>
                </tr>
                <tr>
                    <th scope="row" colspan="2" style="text-align:left;">Total:</th>
                    <td>NPR {{number_format($orderData->total_amount,2)}}</td>
                </tr>
		        </tfoot>
		    </table>
		    </td>
		</tr>
		<tr><td><div style="display:none;font-size:0;max-height:0;line-height:0;padding:0"></div></td></tr>
		<tr>
		    <td>
		        <h2>Billing Address</h2>
		        <address>
		            {{$data['Name']}}<br>
		            {{$data['address1']}}<br>
		            {{$data['address2']}}<br>
		            {{$data['city']}}<br>
		            {{$data['state']}}<br>
		            {{$data['country']}}<br>
		            PIN: {{$data['zipcode']}}<br>
		        </address>
		        <p> Email: {{$data['email']}}</p><br>
		        <p> Phone: {{$data['phone']}}</p>
		    </td>
		</tr>
    </tbody>
</table>
@include('email.email_footer')
</body>
</html>