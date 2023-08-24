<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VendorOnly
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
        if (auth()->user() && auth()->user()->roles->contains('name', 'vendor')) {
            return $next($request);
        }

        return redirect()->route('products.create')->with('error', 'Only vendors can add products.');
    }
}
