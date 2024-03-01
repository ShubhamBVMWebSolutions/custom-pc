<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\ProductCategory;

class StoreFinderController extends Controller
{
    public function index(){
        $data=[];
        $data['states'] = Store::select("state")->where("status","Publish")->distinct()->pluck("state");
        $data['stores'] = Store::where("status","Publish")->get();
        return view('store_index',$data);
    }
    
    public function single($slug){
        $data=[];
        $data['store'] = Store::where("status","Publish")->where('slug',$slug)->first();
        if(empty($data['store'])){
            return abort(404);
        }
        $data['product_categories'] = ProductCategory::all();
        
        return view('store_single',$data);
    }
    
    public function near_search(){
        $data=[];
        $data['states'] = Store::select("state")->where("status","Publish")->distinct()->pluck("state");
        $data['stores'] = Store::where("status","Publish")->get();
        return view('store_index',$data);
    }
}
