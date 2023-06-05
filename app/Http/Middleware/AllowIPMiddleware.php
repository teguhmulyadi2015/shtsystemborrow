<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AllowIPMiddleware
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
        $allowedIPs = ['127.0.0.1', '10.5.5.57', '10.5.5.30', '10.5.5.54', '10.5.5.53', '10.5.1.6', '10.5.5.16', '10.5.5.55']; // Add the IP addresses you want to allow to this array

        if (!in_array($request->ip(), $allowedIPs)) {
            abort(403, 'Unauthorize🤷‍♀️');
        }

        return $next($request);
    }
}
