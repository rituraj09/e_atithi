<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        // check logged in or not
        // if (auth()->check()) {
            // Load the authenticated admin with their associated role
            $admin = Admin::with('roles')->find(auth()->id());
            // Check if the admin has a role and if the role is 'Admin'
            if ($admin && $admin->roles->name === 'admin') {
                return $next($request);
            }
            return redirect()->route('guest-house-admin-login');
        // }
    }
}

/*

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OfficialAdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     *
    public function handle(Request $request, Closure $next): Response
    {
        if ( auth()->user()) {
            return $next($request);
        }

        return redirect()->route('guest-house-admin-login');
    }
}

*/
