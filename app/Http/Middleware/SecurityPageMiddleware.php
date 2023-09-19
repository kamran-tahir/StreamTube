<?php

namespace App\Http\Middleware;

use Closure;

class SecurityPageMiddleware
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
        if(!$request->cookie('show_security_page')){
            $page = \App\Page::where('type','security')
                            ->where('status',1)
                            ->first();

            if (!$page) {
                return $next($request);
            }

            $view =  view('static.security')
                ->with('model' , $page)
                ->with('page' , $page->type)
                ->with('subPage' , '');

            return response($view)->withCookie('show_security_page', true, 1440*365*10);
        }
        return $next($request);
    }
}
