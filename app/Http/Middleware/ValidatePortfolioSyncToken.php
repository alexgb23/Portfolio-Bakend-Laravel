<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ValidatePortfolioSyncToken
{
    public function handle(Request $request, Closure $next)
    {
        $expected = (string) config('portfolio_sync.token');
        $received = (string) $request->header('X-Portfolio-Sync-Token');

        if ($expected === '' || $received === '' || ! hash_equals($expected, $received)) {
            return response()->json([
                'message' => 'Token de sincronización inválido.',
            ], 401);
        }

        return $next($request);
    }
}
