<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EnsureUserHasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        $user = User::with('roles')->find(Auth::id());

        if (!$user->roles->contains('id', 1)) {
            Auth::logout();
            return redirect()->route('web.home.index');
        }

        return $next($request);
    }
}
