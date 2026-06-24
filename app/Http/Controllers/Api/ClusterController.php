<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClusterResource;
use App\Models\Cluster;

class ClusterController extends Controller
{
    public function index()
    {
        $items = Cluster::query()
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        return ClusterResource::collection($items);
    }

    public function show(string $id): ClusterResource
    {
        $item = Cluster::query()
            ->with('servers')
            ->findOrFail($id);

        return new ClusterResource($item);
    }
}
