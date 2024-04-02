<?php

namespace App\Http\Middleware;

use Closure;

class PermissionMiddleware
{
    public function handle($request, Closure $next,  $permission)
    {
        if($permission !== null && auth()->user()->can($permission)) {
            \Session::flash('error', 'Access denied !!');
            return redirect()->to("/");
        }

        return $next($request);

    }
}
