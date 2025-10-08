<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ValidUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        print '<h2 class="text-green-800 text-center text-2xl">This is valid middleware</h2>';
        print '<h2 class="text-green-800 text-center text-2xl">'.$role.'</h2>';

        if(Auth::user()->role == $role){
             return $next($request);
        }elseif(Auth::user()->role == "guest") {
             return redirect()->route('user');
        }else{
             return redirect()->route('login');
             }


        // if(Auth::check() && Auth::user()->role == $role){
        // return $next($request);
        // }
        // else{
        //     return redirect()->route('login');
        //     }
    }

    public function terminate(Request $request, Response $response): void
    {
    //    print '<h2 class="text-red-800 text-center text-2xl">This is Terminate middleware</h2>';

    }
}
