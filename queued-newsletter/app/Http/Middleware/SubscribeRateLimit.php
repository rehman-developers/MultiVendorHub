<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SubscribeRateLimit
{
    public function handle(Request $request, Closure $next): Response
    {
        $key = 'subscribe:'.$request->ip();
        $limit = 3;
        $decay = 3600;

        if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($key, $limit)) {
            return back()->with('error', 'Too many subscriptions in 1 hour!');
        }

        \Illuminate\Support\Facades\RateLimiter::hit($key, $decay);

        return $next($request);
    }
}
