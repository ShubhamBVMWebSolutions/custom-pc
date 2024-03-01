<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KhaltiController extends Controller
{
    function paywithkhalti(){
        dd('ok');
        print_r($_GET);

        if(isset($_GET['pidx'])){
            return redirect(route('order.placed').'?order_id='.$_GET['purchase_order_name']);
        }else{
            return redirect()->route("checkout")->with("error_message","Transaction failed");
        }
        // return view('khalti');
    }

// public function verification(Request $request)
// {
// //hit the khalit server
// $args = http_build_query(array(
// 'token' => $request->input('trans_token'),
// //'amount' => $request->input('amount')
// 'amount' => 200
// ));
// $url = "https://khalti.com/api/v2/payment/verify/";
// # Make the call using API.
// $ch = curl_init();
// curl_setopt($ch, CURLOPT_URL, $url);
// curl_setopt($ch, CURLOPT_POST, 1);
// curl_setopt($ch, CURLOPT_POSTFIELDS,$args);
// curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// // $headers = ['Authorization: Key test_secret_key_3800674e9e0f48e19968f99b8a58b2c5'];
// // $headers = ['Authorization: Key test_secret_key_3800674e9e0f48e19968f99b8a58b'];
// $headers = ['Authorization: Key test_secret_key_3800674e9e0f48e19968f99b8a58b2c5'];
// curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// // Response
// $response = curl_exec($ch);
// $status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
// curl_close($ch);

// print_r($status_code);
// die;
// exit;
// }

    public function verification(Request $request){
        $order_detail = getOrderById($_GET['order_id']);
$user_id = auth()->id();
$userdetails = getUserDetailsById($user_id);
        if($order_detail->total_amount>1000){
            $amount = 1000;
        }else{
            $amount = $order_detail->total_amount;
        }
        $jayParsedAry = [
           "return_url" => url('/checkout/payment/khalti'),
           "website_url" => url(''),
        //   "amount" => $order_detail->total_amount*100,
           "amount" => $amount*100,
           "purchase_order_id" => uniqid(),
           "purchase_order_name" => $order_detail->id,
           "customer_info" => [
                 "name" => $userdetails->first_name.' '.$userdetails->last_name,
                 "email" => $userdetails->email,
                 "phone" => "9811496763"
            ]
        ];

        $url = "https://a.khalti.com/api/v2/epayment/initiate/";
        $payload = json_encode( $jayParsedAry );

        $ch = curl_init( $url );
        # Setup request to send json via POST.

        curl_setopt( $ch, CURLOPT_POSTFIELDS, $payload );
        curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: Key a04209a7b45e45ce8036eee5ad9dcf08'));
        // curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization: Key test_secret_key_2e7521b936d842d1a0f70c83ae8392c2'));
        # Return response instead of printing.
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        # Send request.
        $result = curl_exec($ch);
        curl_close($ch);
        # Print response.
        // echo "<pre>";
        // print_r($result);
        // echo "</pre>";
        // die;

        $jsonKhaltiRespo = json_decode($result);
        if(isset($jsonKhaltiRespo->pidx)){
            echo "<script>window.location.replace('".$jsonKhaltiRespo->payment_url."')</script>";
            // header("Location: ".$jsonKhaltiRespo->payment_url);
        }

    }

}
