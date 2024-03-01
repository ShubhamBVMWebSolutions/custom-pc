<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Config;
use Validator;
use Session;

class CouponController extends Controller
{
    function viewCoupons(){
        $coupons = array();
        $coupons = Coupon::orderBy('id','desc')->get();
        $data = compact('coupons');
        return view('admin.manage-coupon.all_coupons',$data);
    }
    function addupdateCoupon(Request $request, $encCouponId=null){
        $coupon_id = '';
        if(!empty($encCouponId)){
           $coupon_id = $encCouponId;
        }
        
        if($request->isMethod('POST')){
            if(!empty($coupon_id)){
                $coupon = Coupon::find($coupon_id);
            }
            else{
                $coupon = new Coupon;
            }
            
            $coupon->coupon_code = $request->coupon_code;
            $coupon->discount_type = $request->discount_type;
            $coupon->coupon_type = $request->coupon_type;
            $coupon->coupon_amount = $request->coupon_amount;
            $coupon->use_limit = $request->use_limit;
            $coupon->expiry_time = $request->expiry_time;
            
            $isSaved = $coupon->save();
            
            if($isSaved){
                return redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
            }
            else{
                return redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
            }
        }
        
        
        $coupon_details = array();
        if(!empty($coupon_id)){
           $coupon_details = Coupon::find($coupon_id);
        }
        $data = compact('coupon_details');
        return view('admin.manage-coupon.add_update',$data);
    }
}
