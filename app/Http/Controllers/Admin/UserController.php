<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Session;
use Auth;
use Config;
use Response;
use Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SiteMail;
use App\Http\Controllers\SetMailController;

class UserController extends Controller
{
    function viewUsers(){
        $all_users = array();
        $all_users = User::orderBy('name','ASC')->get();
        $data = compact('all_users');
        return view('admin.manage-users.all_users',$data);
    }
    
    function addUser(Request $request){
        if($request->isMethod('POST')){
            
            $rules = array(
                        'name' => 'required|unique:users',
                        'email' => 'required|unique:users',
		    	        'password' => [
                                        'string',
                                        'min:6',             
                                        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
                                      ],
		    	        );
		    	        
		    $validator = Validator::make($request->all(), $rules);
		    
		    if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            
             if($request->hasFile('image'))
		        {
		            $dir = public_path('/').Config::get('constants.PROFILE_IMAGE_PATH');

		            $image = time().'.'.$request->image->getClientOriginalExtension();
		            $uploadImg = $request->file('image')->move($dir , $image);
		        }
            
            $user = new User;
            $user->name = $request->name;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->image = $image;
            $user->remember_token = sha1(time());
            $isSaved = $user->save();
            
            if($isSaved){
                $MailTo = $user->email;
                $Maildata = array(
                            'mailTo'=>$MailTo,
                            'toUserName'=>$user->name,
                            'toName'=>userFullNameById($user->id),
                            'email'=>$MailTo,
                            'password'=>$request->password,
                            );
                                        
                $Mailcontroller = new SetMailController();
                 $Mailcontroller->MailUserCreatedByAdmin($Maildata);
                return redirect()->back()->with('alert-success','New User Added successfully');
            }
            else{
               return redirect()->back()->with('alert-error','New User Failed to add'); 
            }
            
        }
        return view('admin.manage-users.add');
    }
    
    
    function updateUser(Request $request, $encUserId=null){
        $user_id = '';
        $user_id = $encUserId;
        
        if($request->isMethod('POST')){
            $rules = array(
                        'first_name' => 'required',
                        'last_name' => 'required',
                        'email' => 'required',
                      );
                      
            $validator = Validator::make($request->all(), $rules);
            
            
            
            $user = User::find($user_id);
            $username = $user->name;
		    $userEmail= $user->email;
            
            if(!empty($request->password)){
                $rules = array(
                        'password' => [
                                        'string',
                                        'min:6',             // must be at least 10 characters in length
                                        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
                                      ],
                      );
		    	       $password = bcrypt($request->password);
		    	       $user->password = $password;
		    	   }
		    	   
		 if($userEmail!=$request->email)
                {
                     $rules = array(
                        'email' => 'required|unique:users',                        
                      );
                      $validator = Validator::make($request->all(), $rules);
                      if($validator->fails())
                      {
                               /*return Response::json(array(
                                           'errors' => $validator->getMessageBag()->toArray(),
                                 ));*/
                            return redirect()->back()->withErrors($validator)->withInput();
                       }
                }
                
        if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();                 
            }
                
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $SavedResponse = $user->save();
		$UpdatedUserId  =   $user->id;   
		
		if($UpdatedUserId){
		    $MailTo =  EmailByUserId($UpdatedUserId);
		    
		            if(!empty($request->password)){
                       $Maildata = array(
                                        'mailTo'=>$MailTo,
                                        'toUserName'=>$user->name,
                                        'toName'=>userFullNameById($user_id),
                                        'email'=>$MailTo,
                                        'password'=>$request->password,
                                        );
		    	        }
		    	        
		    	     else{
		    	             $Maildata = array(
                                        'mailTo'=>$MailTo,
                                        'toUserName'=>$user->user_name,
                                        'toName'=>userFullNameById($user_id),
                                        'email'=>$MailTo,
                                        'password'=>'',
                                        ); 
		    	        }
		    	        
		    	 $Mailcontroller = new SetMailController();
                 $Mailcontroller->MailUserUpdateByAdmin($Maildata);
                 
                return redirect()->back()->with('alert-success','Information updated successfully');
		}
		
		else{
		    return redirect()->back()->with('alert-error','Information not updated');
		  }
            
        }
        
        $userDetails = array();
        if($user_id){
            $userDetails = User::find($user_id);
        }
        $data = compact('userDetails');
        return view('admin.manage-users.update',$data);
    }
    
    function DyanamicDelete(Request $request){
       $ResponseStatus = 0;
        if($request->ajax())
        {
            $idFor = trim($request->idFor);
            $IsExists_info = User::find($idFor);
            if($IsExists_info)
            {
                $ResponseStatus =  $IsExists_info->delete();        
            }
        }
        $collectArray = array(
                               'status'=>$ResponseStatus, 
                             );
        return json_encode($collectArray); 
    }
    
    function ChangeStatus(Request $request){
        if($request->ajax()){
           $ResponseStatus = 0;
            $user_id = $request->idFor;
            $new_status = $request->statusNew;
            
            $update_user = User::find($user_id);
            $update_user->verified = $new_status;
            $update_user->save();
            $collectArray = array(
                               'status'=>1, 
                             );
        return json_encode($collectArray);
             
            
        }
    }
}
