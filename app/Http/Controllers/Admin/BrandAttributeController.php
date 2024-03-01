<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BrandAttribute;
use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Validator;
use Config;
use Session;

class BrandAttributeController extends Controller
{
    public function viewbrandattribute(){
        $brandattrs = BrandAttribute::get();
    	$attrscount = $brandattrs->count();
    	$data = compact('brandattrs','attrscount');

       return view ('admin.manage_brand_attribute.all_brands',$data);
   }
    public function addupdateBrandAttr(Request $request, $encBrandAttrId=null)
    {
           $brandId='';
            if(!empty($encBrandAttrId))
            {
                $brandId = $encBrandAttrId;
            }

        	if($request->isMethod('POST'))	{

                if(!empty($brandId))
                {
                    $validator = Validator::make($request->all(), [
                        'name'      => 'required',
                    ]);

                    $brandAttr = BrandAttribute::find($brandId);

                }else{
                    // dd('ok1');

                    $validator = Validator::make($request->all(), [
                        'name'      => 'required',
                        'brand_category' => 'required',
                    ]);
                    $brandAttr  = new BrandAttribute;
    		     }


                   if ($validator->fails())
		        {
		            return redirect()->back()->withErrors($validator)->withInput();
		        }

		        if($request->hasFile('banner'))
		        {

		            $dir = public_path('/').Config::get('constants.SITE_PRODUCT_IMAGE');

		            $banner = time().'.'.$request->banner->getClientOriginalExtension();
		            $uploadBanner = $request->file('banner')->move($dir , $banner);
		            $brandAttr->banner = $banner;
	            }

		      $brandAttr->name      =  $request->name;
		      $brandAttr->slug      =  slugify($request->name);
		      $brandAttr->description  =  $request->description;
		      $brandAttr->brand_category_id  =  $request->brand_category;
		      $brandAttr->meta_keywords  =  $request->meta_keywords;
		      $brandAttr->meta_description  =  $request->meta_description;
              $IsSaved = $brandAttr->save();

              if($IsSaved)
                    {
                        return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
                    }
                else{
		           return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
		            }
    	    }
    	    $brandattrdetails=array();
            if(!empty($brandId))
    	    {
    	 	$brandattrdetails = BrandAttribute::find($brandId);
    	   }
           $product_categories = ProductCategory::all();

           $data = compact('brandattrdetails','product_categories');
            return view ('admin.manage_brand_attribute.add_update',$data);
   }


   public function DyanamicDelete(Request $request){
         $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = BrandAttribute::find($idFor);

                $ResponseStatus =  $IsExists_info->delete();

        }
        $collectArray = array(
                               'status'=>$ResponseStatus,
                             );
        return json_encode($collectArray);
   }
}
