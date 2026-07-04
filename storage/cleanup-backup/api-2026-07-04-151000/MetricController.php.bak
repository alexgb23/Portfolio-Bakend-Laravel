<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MetricResource;
use App\Models\Metric;

class MetricController extends Controller
{
    public function index()
    {
        $metrics = Metric::query()
            ->select([
                'id',
                'room',
                'parameter',
                'display_name',
                'category',
                'source_system',
                'value',
                'unit',
                'status',
                'recorded_at',
                'notes',
                'is_featured',
                'sort_order',
                'created_at',
                'updated_at',
            ])
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        return MetricResource::collection($metrics);
    }

    public function show(string $id): MetricResource
    {
        $metric = Metric::query()->findOrFail($id);

        return new MetricResource($metric);
    }
}
