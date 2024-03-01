<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\AdminModels\Admin;
use Illuminate\Support\Facades\Validator;
use File;
use Config;


class AdminController extends Controller
{
    
	   function adminLogin()
     {

         if(Auth::guard('admin')->check())
         {
            return redirect()->route('admin.dashboard');
         }
        return view('admin.login_admins');

     }


    #->Admin Login
    public function adminDoLogin(Request $request)
    {
        
        $rules = array(
                          //'email'   => 'email|required',
                          'name'   => 'required',
                          'password' => 'required'
                      );

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
                 return redirect()->back()->withErrors($validator)->withInput();
                  

       } else{

         if(Auth::guard('web')->check())
         {
              return redirect()->back()->withInput($request->only('name','password', 'remember'))->with('Invalid_credensial','You are already login with user account on same browser , please logout from user account first.');
         }
        if (Auth::guard('admin')->attempt(['name' => $request->name, 'password' => $request->password])) 
        {
            //return redirect()->intended('/admin');
           return redirect()->route('admin.dashboard');
           
        }
        if (Auth::guard('admin')->attempt(['email' => $request->name, 'password' => $request->password])) 
        {
            //return redirect()->intended('/admin');
           return redirect()->route('admin.dashboard');
           
        }
         
          return redirect()->back()->withInput($request->only('name','password', 'remember'))->with('Invalid_credensial','Invalid Login Credentials ');
          // Session::flash('alert-class', 'alert-danger'); 
      }
    }


     function adminDashboard()
     {
       return view('admin.dashboard');
     }

     /*
     *  Logout
     */
     function adminLogout()
     {
        if(Auth::guard('admin')->check())
        {
          Auth::guard('admin')->logout();
        }
        return redirect()->route('admin.login');
     }

    #->view update user profile 
    function viewUpdateProfile(Request $request)
    {  
         $successMsg='';
         $admins_id =  Auth::guard('admin')->user()->id;
         $adminName = Auth::guard('admin')->user()->name;
         if($request->IsMethod('post'))
         {
                if($admins_id)
                {
                    $forAdminInfo = Admin::find($admins_id);

                    $newAdminName = $request->name;
                    if($adminName!= $newAdminName)
                    {
                          $forAdminInfo->name  = $request->name;
                    }

                    
                    $forAdminInfo->email  = $request->email;
                    $forAdminInfo->first_name  = $request->first_name;
                    $forAdminInfo->last_name  = $request->last_name;
                    $ProfileImagename =  $request->old_profile_image;

                    if($request->hasfile('profile_image'))
                    {
                               $rules = array(
                                     'profile_image' => 'required',
                                     'profile_image.*' => 'mimes:jpeg,png | max:20000'                    
                               );

                               $validator = Validator::make($request->all(), $rules);
                               if($validator->fails())
                               {
                                   return redirect()->back()->with('errorMsg', $validator->messages());
                               }

                               $dir = public_path('/').Config::get('constants.PROFILE_IMAGE_PATH');

                               File::delete($dir.$ProfileImagename);

                               $file  =  $request->file('profile_image');
                               echo $ProfileImagename = time().rand(0,100).'.'.$file->extension();
                               $fileType = $file->extension();
                              
                               $file->move($dir, $ProfileImagename); 
                              
                              $forAdminInfo->profile_image  = $ProfileImagename;
                    }

                    $forAdminInfo->save();

                    if($forAdminInfo->id)
                    {
                        $successMsg = 'Info updated successfully';
                    }
                }
           }


        $adminUserInfo = Admin::find($admins_id);
        $data = compact('adminUserInfo','successMsg');
        return view('admin.profile-admins.view_update_profile_admins',$data);
    }


    #->Change password 
    function changePassword(Request $request)
    {
         $loginGuardId = Auth::guard('admin')->user()->id;
          if ($request->isMethod('post'))
          {
            $rules = array(
                          'password'   => 'required|min:3|max:20|confirmed',
                      /*    'password' => [
                                          'required',
                                          'string',
                                          'min:6',             // must be at least 10 characters in length
                                          'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
                                          'confirmed'
                                      ],*/
                          'password_confirmation' => 'required|min:3|max:20'
                      );

          $validator = Validator::make($request->all(), $rules);
          if($validator->fails())
          {
                   
                   return redirect()->back()->withErrors($validator)->withInput();
           }else{

                $password = bcrypt(trim($request->input('password')));
                $UserUpdateArr = array(
                        'password' => $password,
                        );
                 


         $IsUpdate =   Admin::where('id','=',$loginGuardId)->update($UserUpdateArr);
         if(isset($IsUpdate))
         {
          return redirect()->back()->with('successMsg','Password Updated successfully!');
         }else{
          return redirect()->back()->with('errorMsg','Please try again!');
         }  
        }
       } 
        return view('admin.profile-admins.update_password_admin');
    }


    #->site settings 
   function siteSettings(Request $request)
   {
        $successMsg='';
        $forSiteSettings =  SiteSetting::find(1);
        $site_logo = $request->old_site_logo;

         if ($request->isMethod('post'))
         {
               if($request->hasfile('site_logo'))
              {
                               $rules = array(
                                     'site_logo' => 'required',
                                     'site_logo.*' => 'mimes:jpeg,png | max:20000'                    
                               );

                               $validator = Validator::make($request->all(), $rules);
                               if($validator->fails())
                               {
                                   return redirect()->back()->with('errorMsg', $validator->messages());
                               }

                               $file  =  $request->file('site_logo');
                               $site_logo = time().rand(0,100).'.'.$file->extension();
                               $fileType = $file->extension();
                               $dir = 'uploads/site_images/';
                               $file->move($dir, $site_logo); 

                    }


                    $forSiteSettings->site_logo  = $site_logo;
                    $forSiteSettings->site_title = $request->site_title;
                    $forSiteSettings->address    = $request->address ;
                    $forSiteSettings->email      = $request->email ;
                    $forSiteSettings->phone      = $request->phone ;
                    $forSiteSettings->fax        = $request->fax ;
                    $forSiteSettings->footer_site_text   = $request->footer_site_text   ;
                    $forSiteSettings->facebook  = $request->facebook ;
                    $forSiteSettings->twitter   = $request->twitter ;
                    $forSiteSettings->instagram = $request->instagram  ;
                    $forSiteSettings->address = $request->address  ;
                    $forSiteSettings->footer_site_text = $request->footer_site_text  ;
                    $forSiteSettings->save();

                    if($forSiteSettings->id)
                    {
                        $successMsg = 'Info updated successfully';
                    }

         }

           $siteSettings = SiteSetting::find(1);
          $data = compact('siteSettings','successMsg');

        return view('admin/site-settings/view_update_site_settings',$data);
    }


    
}
