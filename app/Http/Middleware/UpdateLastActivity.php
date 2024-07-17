<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Impor model User

class UpdateLastActivity
{
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            /** @var User $user */
            $user = Auth::user();
            $user->last_activity = now();
            $user->save(); // Metode save() adalah metode Eloquent
        }

        return $next($request);
    }
}
