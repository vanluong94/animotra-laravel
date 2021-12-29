<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class VerifyCsrfTokenAll extends VerifyCsrfToken
{
    /**
     * Determine if the HTTP request uses a ‘read’ verb.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function isReading($request)
    {
        return false;
    }
}
