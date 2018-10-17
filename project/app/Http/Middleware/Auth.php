<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class Auth
{
    public function handle($request, Closure $next)
    {
        if(!Session::has('user_data')){
            Session::flash('login','กรุณา Log in ก่อน');
            return redirect('/login');
        }else{
            return $next($request);
        }
    }
}
