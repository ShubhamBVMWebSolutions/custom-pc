<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RAM;
use Config;
use Session;

class RamController extends Controller
{
    function viewRamattribute(){
        $all_rams = '';
        $all_rams = RAM::orderBy('id','DESC')->get();
        $data = compact('all_rams');
        return view('admin.manage-ram.all_rams',$data);
    }
    
    function addupdateRamAttr(Request $request, $encRamAttrId=null){
        $ram_id = '';
        if(!empty($encRamAttrId)){
           $ram_id = $encRamAttrId;
        }
        
        if($request->isMethod('POST')){
            if(!empty($ram_id)){
                $ram = RAM::find($ram_id);
            }
            else{
                $ram = new RAM;
            }
            
            $ram->title = $request->title;
    	   $ram->slug = slugify($request->title);
    	   $isSaved = $ram->save();
    	   if($isSaved){
    	       return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
    	   }
    	   else{
    	       return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
    	   }
        }
        
        $ramDetail = '';
        if(!empty($ram_id)){
            $ramDetail = RAM::find($ram_id);
        }
        $data = compact('ramDetail');
        return view('admin.manage-ram.add_update',$data);
    }
    
    public function DyanamicDelete(Request $request){
         $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = RAM::find($idFor);
           
                $ResponseStatus =  $IsExists_info->delete();        
           
        }
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
   }
}
