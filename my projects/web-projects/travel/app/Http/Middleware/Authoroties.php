<?php

namespace App\Http\Middleware;

use Closure;

class Authoroties
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
        if(!$request->hasHeader('secret') || $request->header('secret') === 0){
            return response()->json(formResponse(401, "Not authorized"));
        }else{
            $user = \App\User::where('token', $request->header('secret'))->first();
            if($user == null){
                return response()->json(formResponse(401, "Not authorized"));
            }
            $request->user = $user;
        }
        return $next($request);
    }
}
