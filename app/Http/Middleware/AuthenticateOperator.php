<?php

namespace App\Http\Middleware;

use Closure;

class AuthenticateOperator
{
    public function handle($request, Closure $next)
    {
      if (! session("auth_operator")) {
        return redirect("admin");
      }
      return $next($request);
    }
}
