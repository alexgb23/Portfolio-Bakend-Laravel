<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\HomeAssistantInstanceResource;
use App\Models\HomeAssistantInstance;

class HomeAssistantInstanceController extends Controller
{
    public function index()
    {
        $items = HomeAssistantInstance::query()
            ->where('is_visible', true)
            ->where('status', 'active')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        return HomeAssistantInstanceResource::collection($items);
    }

    public function show(string $id): HomeAssistantInstanceResource
    {
        $item = HomeAssistantInstance::query()
            ->where('is_visible', true)
            ->where('status', 'active')
            ->with('useCases')
            ->findOrFail($id);

        return new HomeAssistantInstanceResource($item);
    }
}
