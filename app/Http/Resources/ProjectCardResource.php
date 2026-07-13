<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProjectCardResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $darkPaths = [];
        $lightPaths = [];

        if ($this->relationLoaded('adjuntos')) {
            $darkAdjunto = $this->adjuntos
                ->where('es_visible', true)
                ->firstWhere('titulo', 'fondo_tarjeta_dark');

            $lightAdjunto = $this->adjuntos
                ->where('es_visible', true)
                ->firstWhere('titulo', 'fondo_tarjeta_Light');

            $darkPaths = $darkAdjunto?->url
                ? collect(explode(',', $darkAdjunto->url))
                ->map(fn($item) => trim($item))
                ->filter()
                ->values()
                ->all()
                : [];

            $lightPaths = $lightAdjunto?->url
                ? collect(explode(',', $lightAdjunto->url))
                ->map(fn($item) => trim($item))
                ->filter()
                ->values()
                ->all()
                : [];
        }

        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'area_principal' => $this->area_principal,
            'short_description' => $this->short_description,
            'stack_summary' => $this->stack_summary,
            'technologies' => $this->technologies ?? [],

            'card_background_dark' => $darkPaths,
            'card_background_light' => $lightPaths,
        ];
    }
}
