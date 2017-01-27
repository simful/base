<?php

namespace App\Http\Middleware;

use Closure, Auth, Config;

class Tenant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check()) {
            Config::set('database.connections.tenant.database', 'base_' . Auth::user()->agent_id);
        }

        return $next($request);
    }
}
