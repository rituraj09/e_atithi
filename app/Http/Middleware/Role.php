<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {

        if (auth()->user()) {
            $admin = Admin::with('roles')->find(auth()->id());
            if ($admin && $admin->roles->name === $role) {
                return $next($request);
            }
        }
        return redirect()->route('guest-house-admin-login');
    }
}
