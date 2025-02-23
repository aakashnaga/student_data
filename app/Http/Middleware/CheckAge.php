<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class CheckAge
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
        $token = $request->header('Authorization');
        $token = str_replace('Bearer','',$token);

        $tokenPayload = explode('.',$token)[1];
        $decodepayload = base64_decode($tokenPayload);
        $payloadData = json_decode($decodepayload, true);
        dd($payloadData);   
        
        try{
            // dd(5);
            $token = JWTAuth::parseToken()->authenticate();
            dd($token);
            return $next($request);
            if(!token){
                return response()->json(['message'=>'failed']);
            }
        }catch(JWTException $e){
            return response()->json(['error'=>'invalid'],401);

        }

    }
}
