<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class InitialPaymentMiddleware
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
        $user = $request->user();
        if($user && $user->role == 'User' && $user->is_active == true && $user->is_initial_paid == true) {
            return $next($request);
        }
        return redirect(route('user.dashboard'))->with('error', 'You must complete the initial payment before accessing this page.');
    }
}
