<?php

namespace App\Http\Middleware;

use App\Models\UnauthorizedAccessLog;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LogUnauthorizedAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        if ($response->getStatusCode() == 401 && empty($request->user())) {

            if (empty($request->user()) || $request->user() == null) {
                UnauthorizedAccessLog::create([
                    'ip_address' => $request->ip(),
                    'requested_url' => $request->fullUrl(),
                    'attempted_at' => now(),
                ]);
            }

        }

        return $next($request);
    }
}
