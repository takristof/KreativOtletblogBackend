<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $message='';

        try{
            JWTAuth::parseToken()->authenticate();
            return $next($request);
        }catch(\Tymon\JWTAuth\Exceptions\TokenExpiredException $e){
            $message='token lejárt';
        }catch(\Tymon\JWTAuth\Exceptions\TokenInvalidException $e){
            $message='helytelen token';
        }catch(\Tymon\JWTAuth\Exceptions\JWTException $e){
            $message='nem adott meg tokent';
        }
        return response()->json([
            'success'=>false,
            'message'=>$message
        ]);
    }
}
