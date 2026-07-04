<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LaboratoryCardResource;
use App\Http\Resources\LaboratoryDetailResource;
use App\Models\LaboratoryItem;
use Illuminate\Http\Request;

class LaboratorioController extends Controller
{
    public function index(Request $request)
    {
        $items = LaboratoryItem::query()
            ->select([
                'id',
                'name',
                'slug',
                'item_type',
                'category',
                'location_name',
                'status',
                'description',
                'is_featured',
                'is_visible',
                'sort_order',
            ])
            ->where('is_visible', true)
            ->orderByDesc('is_featured')
            ->orderBy('sort_order')
            ->get();

        return LaboratoryCardResource::collection($items);
    }

    public function show(string $id): LaboratoryDetailResource
    {
        $item = LaboratoryItem::query()
            ->where('is_visible', true)
            ->findOrFail($id);

        return new LaboratoryDetailResource($item);
    }
}
