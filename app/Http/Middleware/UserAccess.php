<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        
        if(Auth::check()){
            
            if(app('users_service')->authUser()->hasRole($role)){
        
                return $next($request);
            }
        }
        
        
        return redirect('/home')
        ->with('error', 'Unauthorized. You do not have permission to access this resource.');
    }
}
