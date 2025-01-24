<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and is an admin
        if (!auth()->check()) {
            // Redirect to the login page if not logged in
            return redirect()->route('admin.login');
        }

        // Check if the authenticated user is an admin
        if (!auth()->user()->is_admin) {
            // Optionally, you can redirect to a different page or show a 403 error
            return abort(403, 'Unauthorized');
        }

        // Proceed with the request if the user is an admin
        return $next($request);
    }
}
