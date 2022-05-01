<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class HasValidReferral
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
        if ($request->hasCookie('referral_code')) {
            return $next($request);
        }
        if (($ref = $request->query('ref')) && User::referralFound($ref)) {
            return redirect($request->fullUrl())->withCookie(cookie()->forever('referral_code', $ref));
        }
        return $next($request);
    }
}
