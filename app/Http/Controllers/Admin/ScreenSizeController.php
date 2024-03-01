<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ScreenSize;
use Config;
use Session;

class ScreenSizeController extends Controller
{
    function viewScreenattribute(){
        $all_screens = '';
        $all_screens = ScreenSize::orderBy('id','DESC')->get();
        $data = compact('all_screens');
        return view('admin.manage-screen-size.all_screensizes',$data);
    }
    
    function addupdateScreenAttr(Request $request, $encScreenAttrId=null){
        $screen_id = '';
        if(!empty($encScreenAttrId)){
            $screen_id = $encScreenAttrId;
        }
        
        if($request->isMethod('POST')){
            if(!empty($screen_id)){
    	       $screenSizes = ScreenSize::find($screen_id);
    	   } 
    	   else{
    	       $screenSizes = new ScreenSize;
    	   }
    	   
    	   $screenSizes->title = $request->title;
    	   $screenSizes->slug = slugify($request->title);
    	   $isSaved = $screenSizes->save();
    	   if($isSaved){
    	       return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
    	   }
    	   else{
    	       return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
    	   }
            
        }
        
        $screenDetail = '';
        if(!empty($screen_id)){
            $screenDetail = ScreenSize::find($screen_id);
        }
        $data = compact('screenDetail');
        return view('admin.manage-screen-size.add_update',$data);
    }
    
    public function DyanamicDelete(Request $request){
         $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = ScreenSize::find($idFor);
           
                $ResponseStatus =  $IsExists_info->delete();        
           
        }
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
   }
}
