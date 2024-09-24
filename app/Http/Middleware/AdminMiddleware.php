<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('books.index')->with('error', 'Acesso negado. Somente administradores podem acessar esta página.');
        }

        return $next($request);
    }
}
