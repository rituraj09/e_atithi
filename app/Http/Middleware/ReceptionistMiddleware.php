<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Admin;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReceptionistMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // check logged in or not
        if (auth()->check()) {
            // Load the authenticated admin with their associated role
            $admin = Admin::with('roles')->find(auth()->id());
            // Check if the admin has a role and if the role is 'Admin'
            if ($admin && $admin->role && $admin->roles->name === 'receptionist') {
                return $next($request);
            }
        }

        // return back
        // return redirect()->back();

        return redirect()->route('guest-house-admin-login');
        // if (auth()->user()->role === '4') {
        //     return $next($request);
        // }

        // return redirect()->route('unauthorized');
    }
}
