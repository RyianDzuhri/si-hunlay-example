<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response | JsonResponse
    {
        if(Auth::guard('admin_dinas')->check()){
            return redirect(route('admin.dashboard'));
        }else if(Auth::guard('petugas')->check()){
            return redirect(route('petugas.dashboard'));
        }else if(Auth::guard('warga')->check()){
            return redirect(route('warga.dashboard'));
        }

        return $next($request);
    }
}
