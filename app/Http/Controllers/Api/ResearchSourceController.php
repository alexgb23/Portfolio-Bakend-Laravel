<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ResearchSourceResource;
use App\Models\ResearchSource;

class ResearchSourceController extends Controller
{
    public function index()
    {
        $items = ResearchSource::query()
            ->where('is_visible', true)
            ->where('status', 'active')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        return ResearchSourceResource::collection($items);
    }

    public function show(string $id): ResearchSourceResource
    {
        $item = ResearchSource::query()
            ->where('is_visible', true)
            ->where('status', 'active')
            ->with('metrics')
            ->findOrFail($id);

        return new ResearchSourceResource($item);
    }
}
