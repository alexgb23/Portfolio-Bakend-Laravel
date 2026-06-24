<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LabCapabilityResource;
use App\Models\LabCapability;

class LabCapabilityController extends Controller
{
    public function index()
    {
        $items = LabCapability::query()
            ->where('is_visible', true)
            ->where('status', 'active')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        return LabCapabilityResource::collection($items);
    }

    public function show(string $id): LabCapabilityResource
    {
        $item = LabCapability::query()
            ->where('is_visible', true)
            ->where('status', 'active')
            ->findOrFail($id);

        return new LabCapabilityResource($item);
    }
}
