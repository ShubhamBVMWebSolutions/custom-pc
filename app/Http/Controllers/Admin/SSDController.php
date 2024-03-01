<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SSD;
use Config;
use Session;

class SSDController extends Controller
{
    function viewSSDattribute(){
        $all_ssd = '';
        $all_ssd = SSD::orderBy('id','DESC')->get();
        $data = compact('all_ssd');
        return view('admin.manage-ssd.all_ssd',$data);
    }
    
    function addupdateSSDAttr(Request $request, $encSsdAttrId=null){
        $ssd_id = '';
        if(!empty($encSsdAttrId)){
            $ssd_id = $encSsdAttrId;
        }
        
        if($request->isMethod('POST')){
            if(!empty($ssd_id)){
    	       $ssd = SSD::find($ssd_id);
    	   } 
    	   else{
    	       $ssd = new SSD;
    	   }
    	   
    	   $ssd->title = $request->title;
    	   $ssd->slug = slugify($request->title);
    	   $isSaved = $ssd->save();
    	   if($isSaved){
    	       return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
    	   }
    	   else{
    	       return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
    	   }
            
        }
        
        $ssdDetail = '';
        if(!empty($ssd_id)){
            $ssdDetail = SSD::find($ssd_id);
        }
        $data = compact('ssdDetail');
        return view('admin.manage-ssd.add_update',$data);
    }
    
    public function DyanamicDelete(Request $request){
         $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = SSD::find($idFor);
           
                $ResponseStatus =  $IsExists_info->delete();        
           
        }
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
   }
}
