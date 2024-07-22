<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->is('api/Author/CreateAuthor') && $request->isMethod('post')) {

            if (! $request->user() || ! $request->user()->can('author management')) {
                return response()->json(['Error' => 'You are not authorized.'], 403);
            }
        } elseif ($request->is('api/Author/UpdateAuthor/*') && $request->isMethod('put')) {

            dd($request->user());

            if (! $request->user() || ! $request->user()->can('author management')) {

                return response()->json(['Error' => 'You are not authorized.'], 403);
            }
        } elseif ($request->is('api/Author/DeleteAuthor/*') && $request->isMethod('post')) {

            if (! $request->user() || ! $request->user()->can('author management')) {
                return response()->json(['Error' => 'You are not authorized.'], 403);
            }
        }

        return $next($request);
    }
}
