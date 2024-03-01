<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Omnipay\Omnipay;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseIsRedirected;

class PaypalController extends Controller
{
    private $gateway;

    public function __construct() {
        $this->gateway =Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId('AQEwC4ZJDYhhW7lcH0fKJrNQHcdfjQBO2mslgeNxSUIXRlklOsgfvpLLU2nvv1KbiPprmMbv0aBd74Mk');
        $this->gateway->setSecret('EHbFlLR4J0ffXpDX6SwF6X21YEAW1EqAuvDeMnwzqZojW7lseYaHqSM3CJWgpoaUZ7SDJUf2YOb5Km5S');
        $this->gateway->setTestMode(true);

    }
    public function paywithpaypal(Request $request)
    {
        try {

            $order_id = $request->query('order_id');
            $order = Order::find($order_id);
            $total_amount =$order->total_amount;
            $response=$this->gateway->purchase(array(
                'amount'=> $total_amount,
                'currency'=>'USD',
                'returnUrl'=>route('success',['order_id' => $order_id]),
                'cancelUrl'=>url('error')
            ))->send();
            if ($response->isRedirect()) {
                $response->redirect();
            }else{
                return $response->getMessage();
            }
        } catch (Exception $e) {
            echo($e);
            return $e->getMessage();
        }
    }

    public function success(Request $request, $order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            $order->order_status = 'processing';
            $order->save();
            return redirect()->route('home');
        }
    }
    public function error()
    {
        return redirect()->route('home');
        return "Payment Was Cancled !";
    }
}
