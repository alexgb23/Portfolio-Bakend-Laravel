<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocalAiSetupResource;
use App\Models\LocalAiSetup;

class LocalAiSetupController extends Controller
{
    public function index()
    {
        $items = LocalAiSetup::query()
            ->where('is_visible', true)
            ->where('status', 'active')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        return LocalAiSetupResource::collection($items);
    }

    public function show(string $id): LocalAiSetupResource
    {
        $item = LocalAiSetup::query()
            ->where('is_visible', true)
            ->where('status', 'active')
            ->findOrFail($id);

        return new LocalAiSetupResource($item);
    }
}
