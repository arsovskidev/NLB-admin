<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\WidgetKey;
use Illuminate\Http\Request;

class AuthorizeWidgetKey
{
    const AUTH_HEADER = 'X-Authorization';

    public function handle(Request $request, Closure $next)
    {
        $header = $request->header(self::AUTH_HEADER);
        $widget_key = WidgetKey::getByKey($header);

        if ($widget_key instanceof WidgetKey) {
            return $next($request);
        }

        $response = [
            'status' => 'error',
            'data' => ['message' => 'Unauthorized'],
        ];

        return response()->json($response, 401);
    }
}
