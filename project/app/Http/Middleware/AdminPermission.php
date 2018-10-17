<?php

namespace App\Http\Middleware;
use Session;
use Closure;

class AdminPermission
{
    public function handle($request, Closure $next)
    {
        if(!Session::has('user_data')){
            Session::flash('login','กรุณา Log in ก่อน');
            return redirect('/login');
        }else{
            $s = Session::get('user_data');
            if($s['status']!='admin'){
                return redirect('/');
            }else{
                return $next($request);
            }
        }
    }
}
