<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Response;
use App\Models\User;
use App\Models\VerifyUser;
use Auth;
use App\Mail\SiteMail;
use App\Http\Controllers\SetMailController;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            //'first_name' => $data['first_name'],
            //'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    // do register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'name' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'mobile_number' => 'required|numeric|unique:users',
            'password' => [
                            'required',
                            'string',
                            'min:6',
                            'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
                            'confirmed',
                        ],
        ]);
        $input = $request->all();
        // dd($input);

        if ($validator->passes()) {

            $user = new User();

              $user->name  = $request->name;
              $user->email      = $request->email;
              $user->mobile_number      = $request->mobile_number;
              $user->password   = bcrypt($request->password);
              $user->remember_token = sha1(time());
              $user->first_name  = $request->first_name;
              $user->last_name   = $request->last_name;
              $user->last_session = '';
              $user->verified = '0';
              $SavedResponse  = $user->save();
              $CreatedUserId  =   $user->id;

              if($CreatedUserId){
                  $verifyUser  = new VerifyUser;
                  $verifyUser->user_id = $CreatedUserId;
                  $verifyUser->token = sha1(time());

                  $infoSaved =  $verifyUser->save();

                $first_name = $user->first_name;
                $last_name = $user->last_name;
                $name = $user->name;

                $MailTo =  $user->email;
        //   $MailTo = 'preeti.bvmsolution@gmail.com';
            $Maildata = array(
                            'mailTo'=>$MailTo,
                            'toUserName'=>$name,
                            'name' => $first_name.' '.$last_name,
                            'email'=>$MailTo,
                            'token'=> $user->remember_token,
            );
            $Mailcontroller = new SetMailController();
            $Mailcontroller->NewUserVerificationEmail($Maildata);
              }

            //return Response::json(['success' => '1', 'data' => $SavedResponse]);
            return  redirect()->back()->with('alert-success','Account Created Successfully. Please check your email for the verification link.');

        }
        return redirect()->back()->withErrors($validator)->withInput();
        //return Response::json(['errors' => $validator->errors()]);
    }


    //verify user

    public function verifyUser($token){
        $verifyUser = VerifyUser::where('token', $token)->first();
  if(isset($verifyUser) ){
    $user = $verifyUser->user;
    if(!$user->verified) {
      $verifyUser->user->verified = 1;
      $verifyUser->user->email_verified_at = date('Y-m-d H:i:s');
      $verifyUser->user->save();
    //   return view('VerifyUser.verify');
    return redirect()->route('login');
    } else {
      return view('VerifyUser.verifyalready');
    }
  } else {
    return view('VerifyUser.unverify');
  }
  return redirect()->route('home');
    }

}
