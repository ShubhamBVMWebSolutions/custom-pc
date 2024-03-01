@include('email.email_header')
<?php $order_id = $data['order_id'];
$orderData = getOrderById($order_id); 
$orderItems = orderItemsById($order_id); 

$subtotal = 0;
$coupn_amount = 0;

?>

<table style="width:100%; border: 1px solid#eee; max-width: 600px; margin: 0 auto;">
    <tbody style="display: block;padding: 30px 0; color: #718096;">
        <tr>
			<td colspan="3" style="display: block;">
				<h1 style="margin:0; font-size: 18px;line-height: 30px;">New Order</h1>
			</td>
		</tr>
		<tr>
		    <td><p>{{$data['message']}}</p>
		    <h2>Order #{{$order_id}} ({{date('F j, Y', strtotime($orderData->created_at))}})</h2>
		    </td>
		</tr>
		<tr>
		    <td>
		        <h2>Billing Address</h2>
		        <address>
		            {{$data['Name']}}<br>
		            Email: {{$data['email']}}<br>
		            Phone: {{$data['phone']}}<br>
		            {{$data['address1']}}<br>
		            {{$data['address2']}}<br>
		            {{$data['city']}}<br>
		            {{$data['state']}}<br>
		            {{$data['country']}}<br>
		            PIN: {{$data['zipcode']}}<br>
		        </address>
		        
		    </td>
		</tr>
    </tbody>
</table>
@include('email.email_footer')
</body>
</html>