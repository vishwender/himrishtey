<?php

namespace App\Http\Middleware;

use App\Support\SiteContext;
use Closure;
use Illuminate\Http\Request;

class ResolveSiteContext
{
    /**
     * Resolve the host-specific database and app configuration before the request is processed.
     */
    public function handle(Request $request, Closure $next)
    {
        SiteContext::apply($request->getHost());

        return $next($request);
    }
}
