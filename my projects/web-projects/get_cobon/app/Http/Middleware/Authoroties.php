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
            return response()->json("Not authorized", 401);
        }else{
            $admin = \App\Admin::where('token', $request->header('secret'))->first();
            if($admin == null){
                return response()->json("Not authorized", 401);
            }
            $request->admin = $admin;
        }
        return $next($request);
    }
}
