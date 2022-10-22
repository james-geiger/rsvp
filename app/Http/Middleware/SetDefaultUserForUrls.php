<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Support\Facades\URL;
 
class SetDefaultUserForUrls
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response
     */
    public function handle($request, Closure $next)
    {

		if ($request->user()) {
			URL::defaults(['user' => $request->user()->display_name]);
		}
 
        return $next($request);
    }
}