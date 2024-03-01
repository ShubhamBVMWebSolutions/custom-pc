<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Config;
use App\Models\AdminModels\SiteSetting;

class SiteSettingController extends Controller
{
    public function sitesetting(Request $request){

        if($request->isMethod('POST'))
          {
             $settingIndicator = $request->setting_name;
                 $settingVal =  $request->setting_val;
             if($settingIndicator=='site_logo')
                {
                
                 $settingVal =  $request->old_site_logo;
                 if($request->hasFile('site_logo'))
                 {
                       $dir= Config::get('constants.SITE_IMAGE_PATHS');
                      
                     $imageName = time().'.'.request()->site_logo->getClientOriginalExtension();
                
                  $UploadPath = $request->file('site_logo')->move($dir, $imageName);

                  $settingVal = $imageName;
                   } 
         }
         
          if($settingIndicator=='site_footer_logo')
                {
                
                 $settingVal =  $request->old_site_logo;
                 if($request->hasFile('site_footer_logo'))
                 {
                       $dir= Config::get('constants.SITE_IMAGE_PATHS');
                      
                     $imageName = time().'.'.request()->site_footer_logo->getClientOriginalExtension();
                
                  $UploadPath = $request->file('site_footer_logo')->move($dir, $imageName);

                  $settingVal = $imageName;
                   } 
         }


         if(!empty($settingIndicator))
         {
             
            $updatearr = array(
                             'setting_val'=>$settingVal
                            );
         }
         
           $update = SiteSetting::where('setting_name','=',$settingIndicator)->update($updatearr);
               
           if($update)
           {
             return  redirect()->back()->with('alert-success','successfully done!');
           }else{
               return  redirect()->back()->with('alert-error','Not added please try again');
           }

        
     }
         return view('admin.site_setting.manage_setting');
    }
}
