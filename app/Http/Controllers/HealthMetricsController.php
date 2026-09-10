<?php

namespace App\Http\Controllers;

use App\Services\InfrastructureMetricsService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Throwable;

class HealthMetricsController extends Controller
{
    public function __construct(
        private readonly InfrastructureMetricsService $infrastructure,
    ) {
    }

    public function __invoke(): JsonResponse
    {
        $requestStartedAt = hrtime(true);

        $database = $this->measureDatabase();
        $external = $this->infrastructure->all();

        $response = [
            'status' => $database['status'] === 'connected'
                ? 'healthy'
                : 'degraded',

            'service' => 'portfolio-backend',
            'timestamp' => now()->toIso8601String(),

            'runtime' => [
                'php_version' => PHP_VERSION,
                'laravel_version' => app()->version(),
                'environment' => app()->environment(),
                'timezone' => config('app.timezone'),

                'memory_used_mb' => $this->megabytes(
                    memory_get_usage(false)
                ),

                'memory_reserved_mb' => $this->megabytes(
                    memory_get_usage(true)
                ),

                'memory_peak_mb' => $this->megabytes(
                    memory_get_peak_usage(true)
                ),

                'memory_limit' => ini_get('memory_limit') ?: null,
            ],

            'database' => $database,

            'cloudflare' => [
                'proxy_detected' => request()->headers->has('CF-Ray')
                    || request()->headers->has('CF-Connecting-IP'),

                'ray_id' => request()->header('CF-Ray'),
                'colo' => $this->extractColo(
                    request()->header('CF-Ray')
                ),

                'api' => $external['cloudflare'],
            ],

            'render' => $external['render'],
        ];

        $response['request_duration_ms'] = round(
            (hrtime(true) - $requestStartedAt) / 1_000_000,
            2
        );

        return response()->json($response);
    }

    private function measureDatabase(): array
    {
        $startedAt = hrtime(true);

        try {
            DB::select('SELECT 1');

            return [
                'status' => 'connected',
                'driver' => DB::connection()->getDriverName(),
                'latency_ms' => round(
                    (hrtime(true) - $startedAt) / 1_000_000,
                    2
                ),
            ];
        } catch (Throwable $exception) {
            return [
                'status' => 'disconnected',
                'driver' => config('database.default'),
                'latency_ms' => round(
                    (hrtime(true) - $startedAt) / 1_000_000,
                    2
                ),
                'error' => app()->environment('local')
                    ? $exception->getMessage()
                    : 'Database unavailable',
            ];
        }
    }

    private function extractColo(?string $rayId): ?string
    {
        if (!$rayId || !str_contains($rayId, '-')) {
            return null;
        }

        return strtoupper((string) str($rayId)->afterLast('-'));
    }

    private function megabytes(int $bytes): float
    {
        return round($bytes / 1024 / 1024, 2);
    }
}
