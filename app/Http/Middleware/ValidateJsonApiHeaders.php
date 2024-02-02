<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class ValidateJsonApiHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // if($request->header('accept') !== 'application/vnd.api+json'){
        //     throw new HttpException(406);
        // }

        // if($request->isMethod('POST') || $request->isMethod('PATCH')){
        //     if($request->header('content-type') !== 'application/vnd.api+json'){
        //         throw new HttpException(415);
        //     }
        // }


        if ($request->header('Authorization')) {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized. Missing or invalid Bearer token.'], 401);


    }
}
