<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminMiddleware
{
    public function handle(Request $request, Closure $next)
    {
         if(auth()->check())
        {
            $userRole = auth()->user()->role;
            if($userRole == 0 || $userRole == 1)
            {
                return $next($request);
            }
        }
        return redirect('/')->with('error', 'Unauthorized access.');
    }
}