<?php

namespace App\Http\Middleware;

use App\Models\Permission;
use App\Models\PermissionRole;
use Closure;
use Illuminate\Http\Request;

class CanAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $currentRouteName = $request->route()->getName();
        $permission = Permission::whereRouteNameAndMethod($currentRouteName, $request->method())->first();
        $userPermissions = PermissionRole::whereRoleId(auth()->user()->role_id)->pluck('permission_id')->toArray();
        if (in_array($permission->id, $userPermissions)) {
            return $next($request);
        }else{
            return response()->json('You Are Not Unauthorized', 401);
        }
    }
}
