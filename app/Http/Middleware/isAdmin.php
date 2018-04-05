<?php

namespace App\Http\Middleware;

use Closure;

class isAdmin
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
        if($request->user()->role == 'admin') {
            return $next($request);
        }

        \Session::flash('status', __("Отказано в доступе"));
        return redirect()->action('HomeController@index');
    }
}
