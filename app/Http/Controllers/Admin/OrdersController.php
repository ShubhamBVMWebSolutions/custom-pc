<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\BillingAddress;
use App\Models\GiftcardDetail;
use App\Models\Product;

class OrdersController extends Controller
{
    function allorders(){
        $orders = array();
        $orders = Order::orderBy('created_at','desc')->get();
        $data = compact('orders');
        return view('admin.manage-orders.orders',$data);
    }

    function viewUpdateOrder(Request $request,$encOrderId = null){
        $order_id = '';
        if(!empty($encOrderId)){
            $order_id = $encOrderId;
        }

        if($request->isMethod('POST')){
            $product_id = $request->product_id;
            $product_qty = $request->product_qty;
            $products_ids = explode(',',$product_id);
            $products_qtys = explode(',',$product_qty[0]);

            $order = Order::find($order_id);
            if($order->payment_method == 'cod'){
                if($request->order_status == 'completed'){
                    GiftcardDetail::where('order_id',$order->id)
                    ->update(['status' =>'1']);
                }
            }

            $order->order_status = $request->order_status;
            $isSaved = $order->save();
            if ($order->order_status == 'dispatched' ) {
                for ($i = 0; $i < count($products_ids); $i++) {
                    $product = Product::find($products_ids[$i]);
                    // dd($product);
                    if ($product) {
                        $product->stock_qty -= $products_qtys[$i];
                        $product->save();
                    }
                }
            }else if ($order->order_status == 'cancelled' ) {
                for ($i = 0; $i < count($products_ids); $i++) {
                    $product = Product::find($products_ids[$i]);
                    if ($product) {
                        $product->stock_qty += $products_qtys[$i];
                        $product->save();
                    }
                }
            }
            if($isSaved){
                return redirect()->back()->with('alert-success','Order Updated Successfully!');
            }
            else{
                return redirect()->back()->with('alert-error','Order Update Failed!');
            }
        }

        $orderDetails = array();
        $orderItems = array();
        $orderDetails = Order::find($order_id);
        $orderItems = OrderItems::where('order_id',$order_id)->get();
        $data = compact('orderDetails','orderItems');

        return view('admin.manage-orders.view_order',$data);
    }

    function DyanamicDelete(Request $request){
        $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = Order::find($idFor);
            if($IsExists_info)
            {
                OrderItems::where('order_id','=',$idFor)->delete();
                BillingAddress::where('order_id','=',$idFor)->delete();
                $ResponseStatus =  $IsExists_info->delete();
            }
        }
        $collectArray = array(
                               'status'=>$ResponseStatus,
                             );
        return json_encode($collectArray);

    }
}
