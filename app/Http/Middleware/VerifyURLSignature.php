<?php

namespace App\Http\Middleware;

use Closure;

class VerifyURLSignature
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
        if($request->method() == 'GET' && !$request->hasValidSignature()){
            //abort(403);
        }
        return $next($request);
    }
}
