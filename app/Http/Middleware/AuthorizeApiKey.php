<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\ApiKey;
use App\Models\ApiKeyAccessEvent;
use Illuminate\Http\Request;

class AuthorizeApiKey
{
    const AUTH_HEADER = 'X-Authorization';

    public function handle(Request $request, Closure $next)
    {
        $header = $request->header(self::AUTH_HEADER);
        $api_key = ApiKey::getByKey($header);

        if ($api_key instanceof ApiKey) {
            $this->logAccessEvent($request, $api_key);
            return $next($request);
        }

        $response = [
            'status' => 'error',
            'data' => ['message' => 'Unauthorized'],
        ];

        return response()->json($response, 401);
    }

    protected function logAccessEvent(Request $request, ApiKey $api_key)
    {
        $event = new ApiKeyAccessEvent;
        $event->api_key_id = $api_key->id;
        $event->ip_address = $request->ip();
        $event->url        = $request->fullUrl();
        $event->save();
    }
}
