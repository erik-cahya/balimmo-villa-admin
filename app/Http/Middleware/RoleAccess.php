<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class RoleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role): Response
    {

        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (!$request->user() || $request->user()->role !== $role) {
            // Jika bukan role yang diizinkan, lempar 404
            throw new NotFoundHttpException();
        }

        return $next($request);
    }
}
