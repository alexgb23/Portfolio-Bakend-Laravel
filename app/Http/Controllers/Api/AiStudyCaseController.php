<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AiStudyCaseResource;
use App\Models\AiStudyCase;

class AiStudyCaseController extends Controller
{
    public function index()
    {
        $items = AiStudyCase::query()
            ->where('is_visible', true)
            ->where('status', 'published')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        return AiStudyCaseResource::collection($items);
    }

    public function show(string $id): AiStudyCaseResource
    {
        $item = AiStudyCase::query()
            ->where('is_visible', true)
            ->where('status', 'published')
            ->findOrFail($id);

        return new AiStudyCaseResource($item);
    }
}
