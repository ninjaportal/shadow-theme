<?php

namespace NinjaPortal\Shadow\Middlewares;

use Closure;
use Illuminate\Http\Request;

class SetLocaleMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $lang = $request->cookie("lang");
        if ($lang) {
            app()->setLocale($lang);
        }
        return $next($request);
    }
}
