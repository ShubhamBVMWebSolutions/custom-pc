<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HardDrive;
use Config;
use Session;

class HardDriveController extends Controller
{
    function viewdriveattribute(){
        $all_drives = '';
        $all_drives = HardDrive::orderBy('id','DESC')->get();
        $data = compact('all_drives');
        return view('admin.manage-harddrive.all_drives',$data);
    }
    function addupdateDriveAttr(Request $request, $encDriveAttrId=null){
        $drive_id = '';
        if(!empty($encDriveAttrId)){
            $drive_id = $encDriveAttrId;
        }
        
        if($request->isMethod('POST')){
            if(!empty($drive_id)){
    	       $hardDrives = HardDrive::find($drive_id);
    	   } 
    	   else{
    	       $hardDrives = new HardDrive;
    	   }
    	   
    	   $hardDrives->title = $request->title;
    	   $hardDrives->slug = slugify($request->title);
    	   $isSaved = $hardDrives->save();
    	   if($isSaved){
    	       return  redirect()->back()->with('alert-success',config::get('constants.MESSAGE.SUCCESS_MESSAGE'));
    	   }
    	   else{
    	       return  redirect()->back()->with('alert-error',config::get('constants.MESSAGE.TRY_AGAIN'));
    	   }
            
        }
        
        $driveDetail = '';
        if(!empty($drive_id)){
            $driveDetail = HardDrive::find($drive_id);
        }
        $data = compact('driveDetail');
        return view('admin.manage-harddrive.add_update',$data);
    }
    
    public function DyanamicDelete(Request $request){
         $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = HardDrive::find($idFor);
           
                $ResponseStatus =  $IsExists_info->delete();        
           
        }
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray);
   }
}
