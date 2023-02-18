<?php

namespace App\Http\Middleware;

use App\Services\BracketChecker;
use Closure;
use Illuminate\Http\Request;

class BracketsAuthenticationMiddleware
{
    public function __construct(private readonly BracketChecker $checker) {}

    public function handle(Request $request, Closure $next)
    {
        $authHeader = $request->header('Authorization');
        $pieces = explode(' ', $authHeader);

        if (count($pieces) !== 2 || $pieces[0] !== 'Bearer') {
            abort(401, "Something is not right the Authorization header");
        }

        $authorized = $this->checker->check($pieces[1]);

        if (!$authorized) {
            abort(401, "The brackets don't add up!");
        }

        return $next($request);
    }
}
