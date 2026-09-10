<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Throwable;

class InfrastructureMetricsService
{
    public function render(): array
    {
        $apiKey = config('services.render.api_key');
        $serviceId = config('services.render.service_id');
        $baseUrl = rtrim(
            config('services.render.base_url', 'https://api.render.com'),
            '/'
        );

        if (blank($apiKey) || blank($serviceId)) {
            return [
                'status' => 'not_configured',
            ];
        }

        try {
            $startedAt = hrtime(true);

            $response = Http::acceptJson()
                ->withToken($apiKey)
                ->timeout(5)
                ->get($baseUrl . '/v1/services/' . $serviceId);

            $latency = round(
                (hrtime(true) - $startedAt) / 1_000_000,
                2
            );

            if ($response->failed()) {
                return [
                    'status' => 'unavailable',
                    'http_status' => $response->status(),
                    'latency_ms' => $latency,
                ];
            }

            $data = $response->json();

            return [
                'status' => 'available',
                'latency_ms' => $latency,
                'service_id' => $data['id'] ?? $serviceId,
                'name' => $data['name'] ?? null,
                'type' => $data['type'] ?? null,
                'suspended' => $data['suspended'] ?? null,
                'suspenders' => $data['suspenders'] ?? [],
                'updated_at' => $data['updatedAt'] ?? null,
            ];
        } catch (Throwable $exception) {
            return [
                'status' => 'unavailable',
                'message' => app()->environment('local')
                    ? $exception->getMessage()
                    : 'Render API unavailable',
            ];
        }
    }

    public function cloudflare(): array
    {
        $apiToken = config('services.cloudflare.api_token');
        $zoneId = config('services.cloudflare.zone_id');
        $baseUrl = rtrim(
            config(
                'services.cloudflare.base_url',
                'https://api.cloudflare.com/client/v4'
            ),
            '/'
        );

        if (blank($apiToken) || blank($zoneId)) {
            return [
                'status' => 'not_configured',
            ];
        }

        try {
            $startedAt = hrtime(true);

            $response = Http::acceptJson()
                ->withToken($apiToken)
                ->timeout(5)
                ->get($baseUrl . '/zones/' . $zoneId);

            $latency = round(
                (hrtime(true) - $startedAt) / 1_000_000,
                2
            );

            if ($response->failed()) {
                return [
                    'status' => 'unavailable',
                    'http_status' => $response->status(),
                    'latency_ms' => $latency,
                ];
            }

            $data = $response->json('result', []);

            return [
                'status' => 'available',
                'latency_ms' => $latency,
                'zone_id' => $data['id'] ?? $zoneId,
                'name' => $data['name'] ?? null,
                'zone_status' => $data['status'] ?? null,
                'plan' => data_get($data, 'plan.name'),
            ];
        } catch (Throwable $exception) {
            return [
                'status' => 'unavailable',
                'message' => app()->environment('local')
                    ? $exception->getMessage()
                    : 'Cloudflare API unavailable',
            ];
        }
    }

    public function all(): array
    {
        return [
            'render' => $this->render(),
            'cloudflare' => $this->cloudflare(),
        ];
    }
}
