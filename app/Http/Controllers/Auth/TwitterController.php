<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Models\User;
use Hash;

class TwitterController extends Controller
{
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }
    
    public function handleTwitterCallback()
    {
        try {
            $user = Socialite::driver('twitter')->user();
            $get_email =$user->email;
            $get_twitter_id =$user->id;
                $finduser = User::where(function ($query) use ($get_email, $get_twitter_id){
                        $query->where('email', '=', $get_email)
                        ->orWhere('twitter_id', '=', $get_twitter_id);})->first();
                
                if($finduser){
                    Auth::login($finduser);
                    return redirect(route('user.dashboard'));
                }else{
                    $name_arr = explode(' ',$user->name);
                    $randumString = Random_String(10);
                    $newUser = User::create([
                        'name' => $user->name,
                        'first_name' => $name_arr[0],
                        'last_name' => $name_arr[1],
                        'email' => $user->email,
                        'reg_with' => 'twitter',
                        'twitter_id'=> $user->id,
                        'verified' => 1,
                        'password' => Hash::make($randumString),
                    ]);
                    
                    
               Auth::login($newUser);
               
               return redirect(route('user.dashboard'));
                 
                }
        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }
}
