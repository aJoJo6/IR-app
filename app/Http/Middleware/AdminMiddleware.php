<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    //handle an incoming request.
    public function handle($request, Closure $next)
    {
        if (!session('is_admin')) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}
