<?php

namespace App\Infrastructure\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;

class AuthenticatedMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next): Response|RedirectResponse|JsonResponse
    {
        // return $request->expectsJson() ? null : route('auth.view.login');
        if (!Auth::guard('api')->check()) {
            if ($request->expectsJson()) {
                return response()->json([
                    'message' => 'Session has expired. Please login again.'
                ], 401);
            }
            return redirect()
                ->route('auth.view.login')
                ->with('error', 'Silahkan login terlebih dahulu.');
        }

        return $next($request);
    }
}
