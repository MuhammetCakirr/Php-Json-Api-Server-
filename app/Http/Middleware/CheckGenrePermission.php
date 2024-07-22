<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckGenrePermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is('api/Genre/CreateGenre') && $request->isMethod('post')) {
            if (! $request->user() || ! $request->user()->can('genre management')) {
                return response()->json(['Error' => 'You are not authorized.'], 403);
            }
        } elseif ($request->is('api/Genre/UpdateGenre/*') && $request->isMethod('put')) {
            if (! $request->user() || ! $request->user()->can('genre management')) {
                return response()->json(['Error' => 'You are not authorized.'], 403);
            }
        } elseif ($request->is('api/Genre/DeleteGenre/*') && $request->isMethod('post')) {

            if (! $request->user() || ! $request->user()->can('genre management')) {
                return response()->json(['Error' => 'You are not authorized.'], 403);
            }
        }

        return $next($request);
    }
}
