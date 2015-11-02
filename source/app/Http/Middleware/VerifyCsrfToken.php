<?php namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;
use Config;

class VerifyCsrfToken extends BaseVerifier
{

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */

    public function handle($request, Closure $next)
    {
        $csrf = true;
        foreach (Config::get('auth.no_csrf') as $value) {
            if($request->is($value)){
                $csrf = false;
                break;
            }
        }
        if($csrf){
            return parent::handle($request, $next);
        }
        return $next($request);
    }

}
