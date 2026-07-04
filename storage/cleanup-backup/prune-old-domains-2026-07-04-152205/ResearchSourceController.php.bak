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
            ->visible()
            ->active()
            ->orderByDesc("is_featured")
            ->ordered()
            ->get();

        return ResearchSourceResource::collection($items);
    }

    public function show(string $id): ResearchSourceResource
    {
        $item = ResearchSource::query()
            ->visible()
            ->active()
            ->with("metrics")
            ->findOrFail($id);

        return new ResearchSourceResource($item);
    }
}
