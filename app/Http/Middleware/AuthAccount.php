<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthAccount
{

    public function handle(Request $request, Closure $next): Response
    {
        $auth = Auth::check();
        if (!$auth) {
            return redirect('/');
        }
        return $next($request);
    }
}