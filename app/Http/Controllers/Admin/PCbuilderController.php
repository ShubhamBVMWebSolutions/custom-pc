<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Chipset;
use App\Models\ChipsetGallery;
use App\Models\ChipsetSubCategory;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\PcBudget;
use App\Models\ProductChipsetCatRelation;
use Session;
use Config;
use File;
use DB;

class PCbuilderController extends Controller
{
    function allchipset(){
        $all_chipsets = array();
        $all_chipsets = Chipset::get();
        $data = compact('all_chipsets');
        return view('admin.manage-pcbuilder.all_chipset',$data);
    }
    
    function updateChipset(Request $request,$encChipsetId=null){
        $chipset_id = '';
        $chipset_id = $encChipsetId;
        if($request->isMethod('POST')){
            $chipsetupdate = Chipset::find($chipset_id);
            $chipsetupdate->title = $request->title;
            $chipsetupdate->fps1 = $request->fps1;
            $chipsetupdate->fps2 = $request->fps2;
            $chipsetupdate->fps3 = $request->fps3;
            $chipsetupdate->fps4 = $request->fps4;
            $isSaved = $chipsetupdate->save();
            if($isSaved){
                
                return redirect()->back()->with('alert-success','Updated Successfully!');
            }
            else{
                return redirect()->back()->with('alert-error','Updated Failed!');
            }
        }
        
        $chipset_detail = array();
        $chipset_gallery = array();
        $chipset_detail = Chipset::find($chipset_id);
        $chipset_gallery = ChipsetGallery::where('chipset_id',$chipset_id)->get();
        $data = compact('chipset_detail','chipset_gallery');
        return view('admin.manage-pcbuilder.update_chipset',$data);
    }
    
    function addupdateChipsetSubcat(Request $request, $encChipsetSubcatId=null){
        $subcat_id = '';
        $subcat_id = $encChipsetSubcatId;
        
        if($request->isMethod('POST')){
            $image = '';
            if(empty($subcat_id)){
                $subcat = new ChipsetSubCategory;
            }
            else{
                $subcat = ChipsetSubCategory::find($subcat_id);
                $image = $request->old_image; 
            }
            
            
            
            $subcat->subcat_title = $request->subcat_title;
            $subcat->chipset_id = $request->chipset;
            $subcat->product_id1 = $request->product_id1;
            $subcat->product_id2 = $request->product_id2;
            $subcat->product_id3 = $request->product_id3;
            $subcat->product_id4 = $request->product_id4;
            $isSaved = $subcat->save();
            if($isSaved){
                return redirect()->back()->with('alert-success','Updated Successfully!');
            }
            else{
               return redirect()->back()->with('alert-error','Updated Failed!'); 
            }
        }
        
        $subcat_detail = array();
        $all_products = array();
        $all_chipset = array();
        
        $product1_sum = '';
        $product2_sum = '';
        $product3_sum = '';
        $product4_sum = '';
        
        $all_chipset = Chipset::get();
        $subcat_detail = ChipsetSubCategory::find($subcat_id);
        if(!empty($subcat_detail)){
            $chipset_id = $subcat_detail->chipset_id;
            
            $product1_array = ChipsetSubCategory::where('chipset_id',$chipset_id)->get();
            if(!empty($product1_array)){
                $product1_ids = $product1_array->pluck('product_id1');
                if(!empty($product1_ids)){
                    $product1_sum_details = Product::whereIn("id",$product1_ids)->get();
                    if(!empty($product1_sum_details)){
                        $product1_sum = 0;
                        foreach($product1_sum_details as $product1_sum_detail){
                            if(!empty($product1_sum_detail->sale_price)){
                                $product1_sum += $product1_sum_detail->sale_price;
                            }else{
                                $product1_sum += $product1_sum_detail->price;
                            }
                        }
                    }
                }
            }
            
            $product2_array = ChipsetSubCategory::where('chipset_id',$chipset_id)->get();
            if(!empty($product2_array)){
                $product2_ids = $product2_array->pluck('product_id2');
                if(!empty($product2_ids)){
                    $product2_sum_details = Product::whereIn("id",$product2_ids)->get();
                    if(!empty($product2_sum_details)){
                        $product2_sum = 0;
                        foreach($product2_sum_details as $product2_sum_detail){
                            if(!empty($product2_sum_detail->sale_price)){
                                $product2_sum += $product2_sum_detail->sale_price;
                            }else{
                                $product2_sum += $product2_sum_detail->price;
                            }
                        }
                    }
                }
            }
            
            $product3_array = ChipsetSubCategory::where('chipset_id',$chipset_id)->get();
            if(!empty($product3_array)){
                $product3_ids = $product3_array->pluck('product_id3');
                if(!empty($product3_ids)){
                    $product3_sum_details = Product::whereIn("id",$product3_ids)->get();
                    if(!empty($product3_sum_details)){
                        $product3_sum = 0;
                        foreach($product3_sum_details as $product3_sum_detail){
                            if(!empty($product3_sum_detail->sale_price)){
                                $product3_sum += $product3_sum_detail->sale_price;
                            }else{
                                $product3_sum += $product3_sum_detail->price;
                            }
                        }
                    }
                }
            }
            
            $product4_array = ChipsetSubCategory::where('chipset_id',$chipset_id)->get();
            if(!empty($product4_array)){
                $product4_ids = $product4_array->pluck('product_id4');
                if(!empty($product4_ids)){
                    $product4_sum_details = Product::whereIn("id",$product4_ids)->get();
                    if(!empty($product4_sum_details)){
                        $product4_sum = 0;
                        foreach($product4_sum_details as $product4_sum_detail){
                            if(!empty($product4_sum_detail->sale_price)){
                                $product4_sum += $product4_sum_detail->sale_price;
                            }else{
                                $product4_sum += $product4_sum_detail->price;
                            }
                        }
                    }
                }
            }
            $chipsetSubCatRelation = ProductChipsetCatRelation::where('chip_cat_id',$subcat_detail->id)->where('chipset',$subcat_detail->chipset_id)->get();
            if(!empty($chipsetSubCatRelation)){
                $product_ids = $chipsetSubCatRelation->pluck('product_id');
                if(!empty($product_ids)){
                    $all_products = Product::whereIn('id',$product_ids)->where('product_type','pcbuilder')->get();
                }else{
                    $all_products=array();
                }
            }else{
                $all_products=array();
            }
            
        }else{
            $all_products = Product::where('product_type','pcbuilder')->get();
        }
        
        $budgets = PcBudget::get();
        $data = compact('subcat_detail','all_chipset','all_products','budgets','product1_sum','product2_sum','product3_sum','product4_sum');
       return view('admin.manage-pcbuilder.add_update_subcat',$data); 
    }
    
    function allchipsetSubcat(){
        $allsubcat = array();
        $allsubcat = ChipsetSubCategory::with('product1_details','product2_details','product3_details','product4_details')->get();
        // echo '<pre>';
        // foreach($allsubcat as $key=>$chipset_cat){
           
        //     if(!empty($chipset_cat->product1_details)){
        //         print_r($chipset_cat->product1_details->title);
        //         echo '<br>';
        //     }
        // }
        // die;
        $budgets = PcBudget::get();
        $data = compact('allsubcat','budgets');
        
        return view('admin.manage-pcbuilder.all_chipset_subcat',$data);
    }
    
    
    
}
