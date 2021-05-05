<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class EnsureUserRoleIsAllowedToAccess
{
    /**
     * Handle an incoming request.
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        try {
            $userRole = auth()->user()->role;
            $currentRoleName = Route::currentRouteName();

            if (in_array($currentRoleName, $this->userAccessRole()[$userRole])) {
                return $next($request);
            } else {
                abort(403, 'Unauthorized');
            }
        } catch (\Throwable $th) {
            abort(403, 'Not Allowed');
        }
    }

    /**
     * All of accessible resource for a given user
     *
     *
     * @return void
     */
    private function userAccessRole()
    {
        return [
            'user' => [
                'dashboard'
            ],

            'admin' => [
                'pages',
                'navigation-menus',
                'dashboard',
                'users',
                'user-permissions'
            ]
        ];
    }
}
