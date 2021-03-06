<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class XssFilter
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $requestData = $request->all();

        array_walk_recursive($requestData, function(&$input) {
            $input = filter_var($input, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
        });

        $request->merge($requestData);

        return $next($request);
    }
}
