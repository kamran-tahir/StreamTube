<?php

namespace App\Http\Middleware;

use Closure, Auth, Response;

class ChannelMember
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
        if(!Auth::check()) {
            return redirect(route('user.dashboard'))->with('flash_error', tr('unauthroized_person'));
        }

        if(! userChannelMemberStaus(Auth::user(),request()->channel ?? null) AND !Auth::user()->getChannel->contains(request()->channel)){
            return redirect( route('user.dashboard'))->with('flash_error', tr('unauthroized_person'));
        }
        return $next($request);
    }
}
