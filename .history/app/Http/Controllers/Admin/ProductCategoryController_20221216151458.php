<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Validator;
use Config;
use Session;
use Auth;
use Str;

class ProductCategoryController extends Controller
{
   function addupdateProductCategory(Request $request, $encProductCategoryId=null){  
          $category_id='';
    	if(!empty($encProductCategoryId))
    	{
    		$category_id = $encProductCategoryId;
    	}
    	if($request->isMethod('POST'))
    	{
    	    
    	    $image='';
    	      if(!empty($category_id))
    		     {
    		        $validator = Validator::make($request->all(), [
                      'title'      => 'required',
                  ]); 
                   $productcatDetail = ProductCategory::find($category_id);
                   $image = $request->old_small_icon;
    		     }
    		     else{
    		         $productcatDetail  = new ProductCategory;
    		         $validator = Validator::make($request->all(), [
                      'title'      => 'required|unique:product_category',
                      
                  ]); 
                  
    		     }
    		     if($request->hasFile('small_icon'))
		          {
		              
		            $dir = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE');
		             
		            $image = time().'.'.$request->small_icon->getClientOriginalExtension();
		            $uploadImg = $request->file('small_icon')->move($dir , $image);
		        }
    		     
    		     if ($validator->fails())
		        {
		            return redirect()->back()->withErrors($validator)->withInput();
		        }
    		     
    		     
		  
		      $productcatDetail->title      =  $request->title;
		      $productcatDetail->description      =  $request->description;
		      $productcatDetail->slug      =  slugify($request->title);
		      $productcatDetail->small_icon = $image;
		      $productcatDetail->meta_keywords = $request->meta_keywords;
		      $productcatDetail->meta_description = $request->meta_description;
             
              
              $IsSaved = $productcatDetail->save();
              if($IsSaved)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		            }
    	}
    	    
    	
         $productcatDetail=array();
         if(!empty($category_id))
    	 {
    	 	$productcatDetail = ProductCategory::find($category_id);
    	 }
    	 
    	 $data = compact('productcatDetail');
         return view('admin.manage-product-category.add_update',$data);
     }
     
      function viewproductcategories(){
           $productCat = ProductCategory::orderBy('title','ASC')->get();
    	$productCatCount = $productCat->count();
    	$data = compact('productCat','productCatCount');
           return view('admin.manage-product-category.all_categories',$data);
      }
      
        
    function DyanamicDelete(Request $request)
    {
        $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = ProductCategory::find($idFor);
           
                $ResponseStatus =  $IsExists_info->delete();        
           
        }
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
    }
    
    
     function updaetDyanamicStatus(Request $request)
    {
        $ResponseStatus = 0;
    	if($request->ajax())
    	{
    	    $statusFor = trim($request->statusFor);
    		$idFor     = trim($request->idFor);
    		$statusNew = trim($request->statusNew);
    		if(!empty($statusFor) && !empty($idFor) && !empty($statusNew))
    		{
    		    $isExistsInfo  = ProductCategory::find($idFor);
                    
                    if($isExistsInfo)
                    {
                         $currentStatus = $isExistsInfo->status;
                         if(isset($currentStatus) && $currentStatus==0)
                         {
                             $NewStatus = 1;
                         }else{
                             $NewStatus = 0;
                         }
                         $isExistsInfo->status = $NewStatus;
                         $ResponseStatus = $isExistsInfo->save();
                    } 
    		}
    		else{

    			$ResponseStatus = 0;
    		}
    	}
    	$collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
    }
}
