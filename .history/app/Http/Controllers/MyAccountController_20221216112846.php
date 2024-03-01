<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\BillingAddress;
use App\Models\Order;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\ProductRating;
use Config;
use Session;
use Auth;
use Validator;
use Response;
use Str;

class MyAccountController extends Controller
{
    function dashboard(){
        $user_id = auth()->user()->id;
        $user_details = User::find($user_id);
        $data = compact('user_details');
        return view('myaccount.dashboard',$data);
    }
    
    function editProfile(Request $request){
        $user_id = auth()->user()->id;
        if($request->isMethod('POST')){
            $rules = array();
            $userInfo = User::find($user_id);
            $userEmail= $userInfo->email;
            if(isset($request->curr_password) || isset($request->new_password)){
                $rules = array(
                    'curr_password'  => 'required',
                    'new_password'      => [
                            'required',
                            'string',
                            'min:6',
                            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/'
                        ],
                  );
                  
                 $password = bcrypt($request->password);
		    	 $userInfo->password = $password;
            }
            
            if($userEmail!=$request->email)
                {
                    $rules = array(
                        'email' => 'required|unique:users',                        
                      );
                }
            
            $validator = Validator::make($request->all(), $rules);
            
            if($validator->fails())
              {
                       return redirect()->back()->withErrors($validator)->withInput();
              }
              
              $image = $request->old_profile;
              if($request->hasFile('image'))
		        {
		            $dir = public_path('/').Config::get('constants.PROFILE_IMAGE_PATH');

		            $image = $user_id.$request->image->getClientOriginalName();
		            $uploadImg = $request->file('image')->move($dir , $image);
		        }
		       
            $userInfo->first_name = $request->first_name;
            $userInfo->last_name = $request->last_name;
            $userInfo->email = $request->email;
            $userInfo->image = $image;
            $isSaved = $userInfo->save();
            if($isSaved){
              return redirect()->back()->with('alert-success','Profile Updated Successfully!');
            }
            else{
               return redirect()->back()->with('alert-error','Profile Update Failed'); 
            }
        }
        
        
        $user_details = User::find($user_id);
        $data = compact('user_details');
        return view('myaccount.edit_profile',$data);
    }
    
    function updateAddress(Request $request){
        $user_id  = Auth::user()->id;
        if($request->isMethod('POST')){
            if(!empty($request->billing_address_id)){
                $billingaddress = BillingAddress::find($request->billing_address_id);
            }
            else{
                $billingaddress = new BillingAddress;
            }
            
            $billingaddress->user_id = $user_id;
            $billingaddress->phone = $request->phone;
            $billingaddress->country = $request->country;
            $billingaddress->address1 = $request->address1;
            $billingaddress->address2 = $request->address2;
            $billingaddress->city = $request->city;
            $billingaddress->state = $request->state;
            $billingaddress->zipcode = $request->zipcode;
            $isSaved = $billingaddress->save();
            if($isSaved){
                return redirect()->back()->with('alert-success','Address Updated Successfully!');
            }
            else{
                return redirect()->back()->with('alert-error','Address Update Failed!');
            }
        }
        $billingAddress = BillingAddress::where('user_id',$user_id)->first();
        $data = compact('billingAddress');
        return view('myaccount.billing_address',$data);
    }
    
    function allorders(){
        $user_id = Auth::user()->id ?? '';
        $orders = '';
        $orders = Order::where('user_id',$user_id)->orderBy('id','DESC')->paginate(20);
        if(isset($_GET['action']) && $_GET['action'] == 'cancel'){
           $update_status = Order::find($_GET['order_id']); 
           $update_status->order_status = 'cancelled';
          $update_status->save(); 
          return redirect()->to('/my-account/orders');
        }
        
        $data = compact('orders');
        return view('myaccount.orders',$data);
    }
    
    function vieworder(Request $request, $orderId=null){
        $products = Product::with("product_ratings")->get();
        dd($products);
        $user_id = Auth::user()->id ?? '';
        $orderItems='';
        $orderItems='';
        $billing_address = '';
        $orderDetail = '';
  
        $rating = $request->star;

        $billing_address = BillingAddress::where('user_id',$user_id)->first();
        $orderDetail = Order::find($orderId);
        $orderItems = OrderItems::where('order_id',$orderId)->get();
        $data = compact('orderItems','orderId','orderDetail','billing_address');
        return view('myaccount.view_order',$data);
    }

    function updateStarRating(Request $request){
        if($request->ajax()){
            $product_id = $request->product_id;
            $rating = $request->star;
            $product_rating = ProductRating::where("user_id", auth()->user()->id)->where("product_id", $product_id)->first();
            if(empty($product_rating)){
                $product_rating  =  new ProductRating();
            }
            $product_rating->rating = $rating;
            $product_rating->user_id = auth()->user()->id;
            $product_rating->product_id = $product_id;
            $product_rating->save();
            echo 'success';
        }
    }
}
