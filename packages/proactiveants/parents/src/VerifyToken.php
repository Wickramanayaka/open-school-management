<?php

namespace ProactiveAnts\Parents;

use Closure;
use ProactiveAnts\Parents\ParentsAppUser;

class VerifyToken
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
        if($request->has('token')){
            $user = ParentsAppUser::where('token',$request->token)->where('suspended',0)->first();
            if($user==null){
                return response(['message'=>"Invalid token or account has been suspended."],400);
            }
        }
        else{
            return response(['message'=>"Invalid token"],400);
        }
        return $next($request);
    }
}
