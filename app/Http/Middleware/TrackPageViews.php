<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TrackPageViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $pageUrl = $request->fullUrl();

        // Check if a record exists for this page URL
        $view = DB::table('views')->where('page_url', $pageUrl)->first();

        if ($view) {
            // If the record exists, increment the view count
            DB::table('views')->where('id', $view->id)->increment('count');
        } else {
            // If the record doesn't exist, create a new one
            DB::table('views')->insert(['page_url' => $pageUrl, 'count' => 1]);
        }
        return $next($request);
    }
}
