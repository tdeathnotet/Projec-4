<?php

namespace App\Http\Middleware;

use Closure;

class UserPermission
{
    public function handle($request, Closure $next)
    {
        if(!Session::has('user_data')){
            return redirect('/login');
        }else{
            $s = Session::get('user_data');
            if($s['status']!='user'){
                return redirect('/');
            }else{
                return $next($request);
            }
        }
    }
}
