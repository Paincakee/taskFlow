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

        if ($user && $user->roles->contains(function ($r) use ($role) {
                return $r->name === $role; // Adjust this based on your role attribute
            })) {
            return $next($request);
        }
        dump($user->roles);
        return redirect('/dashboard')->with('error', 'You don\'t have permission to access this page.');
//        return $next($request);
    }
}
