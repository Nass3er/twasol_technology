<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class SuperAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userPriv = User::select('priv')->where('id', Auth::id())->first();
        $userPriv = $userPriv->priv;
        if(!Auth::check() || $userPriv != 0)
            abort(403, "UnAuthorized Access !!" );
        
        return $next($request);
    }
}
