<?php

// app/Http/Middleware/CheckAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAdminPermission
{
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()->adm_perm == 1) {
            return $next($request);
        }
        return redirect('/');
    }
}

