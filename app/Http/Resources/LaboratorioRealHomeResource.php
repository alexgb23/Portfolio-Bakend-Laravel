<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LaboratorioRealHomeResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $iconMap = [
            'Laravel' => 'laravel',
            'PHP 8.4' => 'php',
            'PHP' => 'php',
            'Docker' => 'docker',
            'Docker Compose' => 'docker',
            'Render' => 'render',
            'Neon PostgreSQL' => 'postgresql',
            'PostgreSQL' => 'postgresql',
            'Filament' => 'filament',
            'Sanctum' => 'laravel',
            'Resend' => 'resend',
            'React' => 'react',
            'Vite' => 'vite',
            'Python' => 'python',
            'Linux' => 'linux',
            'Kubernetes' => 'kubernetes',
            'Proxmox' => 'proxmox',
            'Home Assistant' => 'homeassistant',
            'PfSense' => 'pfsense',
        ];

        $stack = collect(data_get($this, 'metadata.stack', []))
            ->map(function ($item) use ($iconMap) {
                if (is_array($item)) {
                    return [
                        'label' => $item['label'] ?? $item['icon'] ?? 'Tecnología',
                        'icon' => $item['icon'] ?? null,
                    ];
                }

                return [
                    'label' => $item,
                    'icon' => $iconMap[$item] ?? null,
                ];
            })
            ->filter(fn($item) => !empty($item['icon']))
            ->take(6)
            ->values();

        return [
            'id' => $this->id,
            'titulo' => $this->titulo,
            'slug' => $this->slug,
            'categoria' => $this->tipo_proyecto ?? 'laboratorio',
            'estado' => $this->estado ?? 'activo',
            'activo' => ($this->estado ?? null) === 'activo',
            'resumen' => $this->resumen ?: $this->descripcion,
            'areas_relacionadas' => $this->areas_relacionadas ?? [],
            'stack' => $stack,
            'projects_count' => $this->whenCounted('projects'),
        ];
    }
}
