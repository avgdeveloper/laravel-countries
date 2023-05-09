<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {


        $ip_address = $request->ip();
        // die($ip_address);

        $pattern = '/^(46\.(12[0-1]|[7-9][0-9]|1[01][0-9])\.'
        . '|46\.210\.'
        . '|46\.228\.(14[4-9]|15[0-9])\.'
        . '|62\.0\.)/';

        if (preg_match($pattern, $ip_address) || $ip_address == '127.0.0.1') {
            return $next($request);
        }
        else {
            return response('Unauthorized IP', 401);
        }
    }
}
