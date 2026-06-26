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
            ->visible()
            ->active()
            ->orderByDesc("is_featured")
            ->ordered()
            ->get();

        return HomeAssistantInstanceResource::collection($items);
    }

    public function show(string $id): HomeAssistantInstanceResource
    {
        $item = HomeAssistantInstance::query()
            ->visible()
            ->active()
            ->with("useCases")
            ->findOrFail($id);

        return new HomeAssistantInstanceResource($item);
    }
}
