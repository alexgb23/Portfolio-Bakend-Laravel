<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\SocialLinkResource;
use App\Models\SocialLink;
use Illuminate\Http\JsonResponse;

class HomeLabResumenController extends Controller
{
    public function __invoke(): JsonResponse
    {
        $socialLinks = SocialLink::query()
            ->visible()
            ->ordered()
            ->get();

        return response()->json([
            'status' => 'success',
            'service' => 'home-lab-resumen',
            'social_links' => SocialLinkResource::collection($socialLinks),
        ]);
    }
}
