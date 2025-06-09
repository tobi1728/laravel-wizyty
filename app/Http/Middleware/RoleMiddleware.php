<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoleMiddleware
{
    public function handle($request, Closure $next, string $roles)
    {
        $user = Auth::user();

        if ($user->role !== $roles) {
            abort(403, 'Nie masz dostępu do tej strony.');
        }

        return $next($request);
    }
}