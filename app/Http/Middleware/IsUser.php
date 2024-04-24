<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::user()->role->nama == "user" || Auth::user()->role->nama == "pelanggan"){
            ## redirect to home page
            // return redirect("/welcome");
            return abort(403);
        } else {
            ## redirect to admin page
            // abort(403);
            return $next($request);
        }
    }
}