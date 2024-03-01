<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
class IsActiveUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
         $user          =  Auth::user();
         $user_status   =  $user['status'];

         if(!empty($user_status))
         {
            return $next($request);

         }else{

             return redirect()->route('logout');
         }
    }
}
