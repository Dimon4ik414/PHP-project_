<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->hasRole(User::ROLE_ADMIN)) {
            abort(403, 'Доступ запрещён.');
        }

        return $next($request);
    }
}
