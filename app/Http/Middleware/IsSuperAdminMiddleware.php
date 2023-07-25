<?php

namespace App\Http\Middleware;

use App\Traits\HttpResponses;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsSuperAdminMiddleware
{
    use HttpResponses;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

     //0 user
     //1 admin
     //2 superAdmin
     //3 Owner
    public function handle(Request $request, Closure $next)
    {
        if (Auth()->check() && Auth::user()->role > 1)
            return $next($request);

        return $this->error('', 'You Have no Access To this page', 404);
    }
}
