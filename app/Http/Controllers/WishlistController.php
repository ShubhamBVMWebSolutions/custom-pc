<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;

class WishlistController extends Controller
{
    public function index(){
        $data = [];
        $data['wishlist'] = Wishlist::where("user_id",auth()->user()->id)->get();
        return view('myaccount.wishlist',$data);
    }
    
    
    public function toggle_wishlist_product(Request $request){
        $product_id = $request->product_id;
        $product = Product::find($product_id);
        $user_id = auth()->user()->id;
        $flag = 0;
        if(!empty($product)){
            if($product->status == 1){
                $wishlist = Wishlist::where("product_id",$product_id)->where("user_id",$user_id)->first();
                if(empty($wishlist)){
                    $wishlist = new Wishlist();
                    $wishlist->user_id = $user_id;
                    $wishlist->product_id = $product->id;
                    $wishlist->save();
                    $flag = 1; 
                }else{
                    $wishlist->delete();
                }
                if($flag == 1){
                    $output["message"] = "Item added to wishlist.";
                }else{
                    $output["message"] = "Item removed from wishlist.";
                }
                $output["response"] = true;
                $output["status"] = $flag;
                
            }else{
                $output["response"] = false;
                $output["message"] = "Invalid Request";
            }
        }else{
            $output["response"] = false;
            $output["message"] = "Invalid Request"; 
        }
        return response()->json($output);
    }
    
    public function clear_wishlist(){
        $wishlist = Wishlist::where("user_id",auth()->user()->id)->delete();
        session()->flash("success_message","Wishlist Cleared.");
        return redirect()->back();
    }
}
