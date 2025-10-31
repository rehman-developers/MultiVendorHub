<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSubscriberActive
{
    public function handle(Request $request, Closure $next): Response
    {
        // Example logic - adjust as needed
        return $next($request);
    }
}