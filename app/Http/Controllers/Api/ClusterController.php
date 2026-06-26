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
            ->active()
            ->orderByDesc("is_featured")
            ->ordered()
            ->get();

        return ClusterResource::collection($items);
    }

    public function show(string $id): ClusterResource
    {
        $item = Cluster::query()
            ->active()
            ->with("servers")
            ->findOrFail($id);

        return new ClusterResource($item);
    }
}
