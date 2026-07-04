<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NodeResource;
use App\Models\Node;

class NodeController extends Controller
{
    public function index()
    {
        $nodes = Node::query()
            ->select([
                'id',
                'node_name',
                'location_name',
                'type',
                'source_system',
                'protocol',
                'current_value',
                'unit',
                'ip_address',
                'status',
                'last_seen_at',
                'is_active',
                'notes',
                'is_featured',
                'sort_order',
                'created_at',
                'updated_at',
            ])
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        return NodeResource::collection($nodes);
    }

    public function show(string $id): NodeResource
    {
        $node = Node::query()->findOrFail($id);

        return new NodeResource($node);
    }
}
