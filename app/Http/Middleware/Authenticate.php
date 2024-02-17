<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // dd(auth()->user());
        if (!auth()->check()) {
            return route('guest-house-admin-login'); // Customize the redirect URL as needed
        }
        // return $request->expectsJson() ? null : route('guest-house-admin-login');
    }
}
