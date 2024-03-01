<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Mail\SiteMail;
use App\Http\Controllers\SetMailController;
use Auth;
use Response;
use Hash;
use App\Models\User;
use Session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    #->Logout user
    function logout(Request $request)
    {

        if($request->isMethod('post'))
        {
          Auth::guard('web')->logout();
           return redirect('/');
        }
        Auth::guard('web')->logout();
         return redirect('/');
    }
    //start code by sk
    function send_otp(Request $request){
         $validator = Validator::make($request->all(), [
            'm_number' => 'required|numeric',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'status' => 404,
                'error' => $validator->errors()
            ]);
        }else{
            $otp = rand(1000,9999);
            $mobile = $request->m_number;
            $user = User::where("mobile_number", $mobile)->first();

            if(empty($user)){
                return response()->json(['status' =>"error",'title'=>"Error",'message' => "Mobile number not registered."]);
            }

            $message = "Your OTP is ". $otp;

            $res = sendOtpOnMobile($mobile, urlencode($message));
            $res = json_decode($res,true);

            // print_r($res);

            // $res["code"] = "ok";
            // $res["message"] = "Otp Sent";

            if($res["code"] == "ok" ){
                $user->otp = $otp;
                $user->save();
                return response()->json(['status' =>"success",'title'=>"Success",'message' =>$res["message"]]);
            }else{
                return response()->json(['status' =>"error",'title'=>"Error",'message' => $res["message"]]);
            }
        }
    }


    function mobile_login(Request $request){
            if($request->isMethod('post')){
                $validator = Validator::make($request->all(), [
                    'mobile_number' => 'required|numeric',
                    'otp' => 'required|numeric',
                ]);

                if($validator->fails())
                {
                    return response()->json([
                        'status' => 404,
                        'error' => $validator->errors()
                    ]);
                }else{
                    $mobile = $request->mobile_number;
                    $otp = $request->otp;

                    $user = User::where("mobile_number", $mobile)->where("otp", $otp)->first();
                    if(empty($user)){
                        return response()->json(['status' =>"error",'title'=>"Error",'message' => "OTP not matched."]);
                    }

                    Auth::loginUsingId($user->id);
                    return response()->json(['status' =>"success",'title'=>"Success",'message' =>'Sucessfully logged in.']);

                }
            }
            return view("auth.mobile_login");
    }
    //end code by sk
    function login(Request $request){
        $curr_lang = session('locale');
        $msgs='';
        $rules = array(
          'log_email'   => 'email|required',
          'log_password' => 'required'
        );
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
        {
                 return redirect()->back()->withErrors($validator)->withInput();
        }
        else{
            $email =  trim($request->input('log_email'));
            $password =  trim($request->input('log_password'));

            $userDetislIsEmail = User::where([
                ['email', '=', $email],
                ['verified', '=', 1],
                ])->first();

            if($userDetislIsEmail)
               {
                   $IsPassRight =  Hash::check($password, $userDetislIsEmail->password);
                
                   if($IsPassRight)
                   {
                       $GetuserStatus = User::where('email', '=', $email)->get();
                       $userStatus = $GetuserStatus[0]['status'];


                    $user_data = array(
                                    'email'  => $request->get('log_email'),
                                    'password' => $request->get('log_password'),
                                    );

                            if(Auth::attempt($user_data))
                           {
                               $user = Auth::user();
                               $userUpdate = User::where('email',$request->get('log_email'))->first();

                              $userUpdate->last_session = session()->getId();
                              $userUpdate->save();
                              if (!empty($msgs)) {
                                 return redirect()->route('user.dashboard');
                                  //return Response::json(['success' => "login"]);
                              } else{
                                  return redirect()->route('user.dashboard');
                                  //return Response::json(['success' => "login"]);
                              }
                           }
                   }
                   else{
                       $wrongpass_msg = 'Password is wrong';
                       return  redirect()->back()->with('alert-error',$wrongpass_msg);
                   }
               }
               else{
                   $unverify_msg = 'Your account is not verified.';
                   return  redirect()->back()->with('alert-unverify',$unverify_msg);
               }
        }

    }

    public function resendVerifyLink(Request $request){

        if($request->ajax()){
            $email = $request->email;

            $userDetislIsEmail = User::where([
                ['email', '=', $email],
                ['verified', '=', 0],
                ])->first();

            if($userDetislIsEmail != null){
                $first_name = $userDetislIsEmail->first_name;
                $last_name = $userDetislIsEmail->last_name;
                $name = $userDetislIsEmail->name;
                $MailTo = $email;
                $Maildata = array(
                            'mailTo'=>$MailTo,
                            'toUserName'=>$name,
                            'name' => $first_name.' '.$last_name,
                            'email'=>$MailTo,
                            'token'=> $userDetislIsEmail->remember_token,
                                          );
                $Mailcontroller = new SetMailController();
                return Response::json(['message' => 'Link Send Successfully!', 'status'=> 1]);
            }else{
                return Response::json(['message' => 'User Not Found!','status'=> 0]);
            }
        }
    }

}
