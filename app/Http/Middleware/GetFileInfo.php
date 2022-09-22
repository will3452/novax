<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class GetFileInfo
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
        if ($request->has('file')) {
            $type = $request->file('file')->getClientOriginalExtension();
            $size = $request->file('file')->getSize();
            $user_id = auth()->id();
            $request->merge(['type' => $type, 'size' => $size, 'user_id' => $user_id]);
            error_log('REQUEST >> ' . json_encode($request->all()));
        }
        return $next($request);
    }
}
