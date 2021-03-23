<?php

namespace App\Http\Middleware;

use Closure;
use Http;
use Illuminate\Http\Request;

class AuthCheck
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
        $res= Http::withHeaders(['token'=>$request->header('token')])->get(env('AUTH_URL').'/api/check')->json();
        if(!isset($res['id'])){
            return response(['message' => 'authorize failed'], 401);
        }
        return $next($request);
    }
}
