<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Admin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::user()->role !== 'admin') {
            return redirect()->back()
                ->with('error', 'Only admin can do that bruh');
        }

        return $next($request);
    }
}
