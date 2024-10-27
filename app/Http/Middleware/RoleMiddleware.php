<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect('login');
        }

        $user = Auth::user();

        // Check if the user has the required role
        if ($user->role !== $role) {
            // abort(403, 'Unauthorized action.');
            if($user->role == 'admin'){
                return redirect('destination');
            }
            
            return redirect('destinationFront'); // or you can redirect them somewhere
        }
        
           
        

        return $next($request);
    }
}
