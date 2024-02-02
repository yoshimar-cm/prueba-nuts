<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request,)
    {
        if($request->header('Content-Type') == 'application/json'){
            if (!boolval($request->header('Authorization'))) {
                throw new HttpException(401);
            }

        }else{
            return $request->expectsJson() ? null : route('login');
        }

    }
}
