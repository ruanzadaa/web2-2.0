<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            return redirect('/home'); // Redireciona para a página inicial ou outra rota se já estiver autenticado
        }

        return $next($request);
    }
}
