<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use Auth;
use Exception;
use App\Models\User;
use Hash;

class GoogleController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $google_profileName = $user->email;

            if(!empty($google_profileName)){

            $finduser = User::where('email', $user->email)->first();
            //$finduser = User::where('google_id', $user->id)->first();
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
                    'reg_with' => 'google',
                    'google_id'=> $user->id,
                    'verified' => 1,
                    'password' => Hash::make($randumString),
                ]);


           Auth::login($newUser);

           return redirect(route('user.dashboard'));

            }
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }

    }
}
