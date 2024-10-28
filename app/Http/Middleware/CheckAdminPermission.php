<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdminPermission
{
    public function handle(Request $request, Closure $next)
    {
    
        if (!Auth::check() || !Auth::user()->adm_perm) {
            return redirect('/');
        }

        return $next($request);
    }
}
