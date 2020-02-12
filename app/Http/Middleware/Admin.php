<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
//use Illuminate\Auth\Middleware\Authenticate as Middleware;
class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $userRole = \Auth::user();
////        dd($request->all());
//        if($request->customer == 'customer'){
//            return redirect('/');
//        }else{
//            return redirect('home');
//        }
//        return $next($request);

        $logged_in_user = Auth::user();
        if(isset($logged_in_user) && $logged_in_user->role == 1) {
            return $next($request);
        } else {
            return redirect('/');
        }
    }
}
