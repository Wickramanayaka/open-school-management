<?php

namespace ProactiveAnts\Parents;

use Closure;

class VerifyAPIKey
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
        if($request->api_key<>config('parents.api_key')){
            return response(['message'=>"Invalid API key"],400);
        }
        return $next($request);
    }
}
