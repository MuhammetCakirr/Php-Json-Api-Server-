<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBookPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('api/Book/CreateBook') && $request->isMethod('post')) {
            if (! $request->user() || ! $request->user()->can('book management')) {
                return response()->json(['Error' => 'You are not authorized.'], 403);
            }
        } elseif ($request->is('api/Book/UpdateBook/*') && $request->isMethod('put')) {
            if (! $request->user() || ! $request->user()->can('book management')) {
                return response()->json(['Error' => 'You are not authorized.'], 403);
            }
        } elseif ($request->is('api/Book/DeleteBook/*') && $request->isMethod('post')) {

            if (! $request->user() || ! $request->user()->can('book management')) {
                return response()->json(['Error' => 'You are not authorized.'], 403);
            }
        }

        return $next($request);
    }
}
