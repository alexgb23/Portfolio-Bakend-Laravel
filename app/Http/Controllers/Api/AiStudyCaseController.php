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
            ->visible()
            ->orderByDesc("is_featured")
            ->ordered()
            ->get();

        return AiStudyCaseResource::collection($items);
    }

    public function show(string $id): AiStudyCaseResource
    {
        $item = AiStudyCase::query()
            ->visible()
            ->findOrFail($id);

        return new AiStudyCaseResource($item);
    }
}
