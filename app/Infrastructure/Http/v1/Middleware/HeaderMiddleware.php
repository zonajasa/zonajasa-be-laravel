<?php

namespace App\Infrastructure\Http\v1\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\JsonResponse;

class HeaderMiddleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {

        if (!$request->header('X-API-PLATFORM')) {
            return ErrorRes('Please insert platform', 401);
        }

        if (!$request->header('X-API-VERSION')) {
            return ErrorRes('Please insert version', 401);
        }

        if (!$request->header('X-API-CLIENT-KEY')) {
            return ErrorRes('Please insert client key', 401);
        }

        $platform = DB::table('headers')->where('platform', $request->header('X-API-PLATFORM'))->first();

        if (!$platform) {
            return ErrorRes('Wrong Platform', 401);
        }

        if ($request->header('X-API-VERSION') != $platform->version) {
            return ErrorRes('Wrong version', 401);
        }

        if ($request->header('X-API-CLIENT-KEY') != $platform->client_key) {
            return ErrorRes('Wrong client key', 401);
        }

        return $next($request);
    }
}
