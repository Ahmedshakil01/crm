<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {		
        if (! $request->expectsJson()) {			
			if(request()->segment(1) == 'administration'){
				return route('administration');
			}
			elseif(request()->segment(1) == 'administration' && collect(request()->segments())->last() == 'dashboard'){
				return route('administration.dashboard');
			}
			else{
				return route('administration');
			} 
			          
        }
    }
}
