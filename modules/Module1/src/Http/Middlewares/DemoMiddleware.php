<?php
namespace Modules\Module1\src\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;

class DemoMiddleware {
    public function handle(Request $request, Closure $next) {
        return $next($request);
    }
}
