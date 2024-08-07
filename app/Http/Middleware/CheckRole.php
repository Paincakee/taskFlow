<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = auth()->user();

        if ($user) {
            $hasRole = $user->roles->contains(function ($r) use ($role) {
                return $r->role === $role;
            });

            if ($hasRole) {
                return $next($request);
            }
        }

        return redirect('/dashboard')->with('error', 'You don\'t have permission to access this page.');
    }
}
