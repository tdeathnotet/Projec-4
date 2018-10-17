<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckStatus
{

    public function handle($request, Closure $next)
    {
        $response = $next($request);
        
        return $response;
    }

}