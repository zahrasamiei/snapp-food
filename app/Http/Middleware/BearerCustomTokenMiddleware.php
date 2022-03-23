<?php

namespace App\Http\Middleware;

use App\Traits\ResponseApi;
use Closure;
use Illuminate\Http\Request;

class BearerCustomTokenMiddleware
{
    use ResponseApi;

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
        $validToken = env("CUSTOM_AUTH_TOKEN");

        if ($token != "Bearer ".$validToken) {
            return self::fail(
                __("messages.forbidden"),
                401
            );
        }
        return $next($request);
    }
}
