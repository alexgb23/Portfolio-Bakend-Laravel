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
            ->visible()
            ->active()
            ->orderByDesc("is_featured")
            ->ordered()
            ->get();

        return LocalAiSetupResource::collection($items);
    }

    public function show(string $id): LocalAiSetupResource
    {
        $item = LocalAiSetup::query()
            ->visible()
            ->active()
            ->findOrFail($id);

        return new LocalAiSetupResource($item);
    }
}
