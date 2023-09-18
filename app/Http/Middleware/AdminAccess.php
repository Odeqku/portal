<?php

namespace App\Http\Middleware;

use App\Providers\Services\DataBaseServices\ReturnUserProfileServices as P;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if(Auth::check()){
            
            if(app('profile_service')->userProfile() === $role){
        
                return $next($request);
            }
        }
        
        // dd('redirect');
        return redirect('/home')
        ->with('error', 'Unauthorized. You do not have permission to access this resource.');
    }
}
