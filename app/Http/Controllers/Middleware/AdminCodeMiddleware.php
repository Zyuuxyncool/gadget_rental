<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AdminCodeMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('kode')) {
            if ($request->kode === env('ADMIN_SECRET_CODE')) {
                session(['admin_verified' => true]);
                return redirect($request->url()); // hilangkan ?kode=... setelah login
            } else {
                return redirect('/');
            }
        }

        if (!session('admin_verified')) {
            return redirect('/');
        }

        return $next($request);
    }
}
