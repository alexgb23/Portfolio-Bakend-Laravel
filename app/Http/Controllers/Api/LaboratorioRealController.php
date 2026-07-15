<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LaboratorioRealHomeResource;
use App\Http\Resources\LaboratorioRealListResource;
use App\Http\Resources\LaboratorioRealResource;
use App\Models\LaboratorioReal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

/**
 * @tags Laboratorios reales
 */
class LaboratorioRealController extends Controller
{
    /**
     * Devuelve una selección resumida de laboratorios reales visibles.
     *
     * Pensado para home, previews o listados destacados.
     */
    public function home(): JsonResponse
    {
        $laboratorios = LaboratorioReal::query()
            ->where('es_visible', true)
            ->where('es_destacado', true)
            ->withCount(['projects'])
            ->orderBy('orden')
            ->orderByDesc('id')
            ->limit(6)
            ->get();

        $statsSource = LaboratorioReal::query()
            ->where('es_visible', true)
            ->withCount(['documentacion', 'projects'])
            ->get();

        $allStacks = $statsSource
            ->pluck('metadata.stack')
            ->filter()
            ->flatten(1)
            ->filter()
            ->values();

        $uniqueTechnologies = $allStacks
            ->map(function ($item) {
                if (is_array($item)) {
                    return $item['label'] ?? null;
                }

                return is_string($item) ? $item : null;
            })
            ->filter()
            ->unique()
            ->values();

        $topTechnologies = $uniqueTechnologies
            ->take(8)
            ->values();

        return response()->json([
            'stats' => [
                'active_laboratories' => $statsSource->where('estado', 'activo')->count(),
                'technologies_count' => $uniqueTechnologies->count(),
                'documents_count' => $statsSource->sum('documentacion_count'),
                'projects_count' => $statsSource->sum('projects_count'),
            ],
            'top_technologies' => $topTechnologies,
            'featured_laboratories' => LaboratorioRealHomeResource::collection($laboratorios),
        ]);
    }

    /**
     * Lista todos los laboratorios reales visibles en formato resumido.
     */
    public function index(): AnonymousResourceCollection
    {
        $laboratorios = LaboratorioReal::query()
            ->where('es_visible', true)
            ->withCount(['documentacion', 'avances', 'adjuntos', 'ideas', 'projects'])
            ->orderBy('orden')
            ->orderByDesc('id')
            ->get();

        return LaboratorioRealListResource::collection($laboratorios);
    }

    /**
     * Devuelve el detalle completo de un laboratorio real visible a partir de su slug.
     */
    public function show(string $slug): LaboratorioRealResource
    {
        $laboratorio = LaboratorioReal::query()
            ->where('slug', $slug)
            ->where('es_visible', true)
            ->with(['documentacion', 'avances', 'adjuntos', 'ideas', 'projects'])
            ->firstOrFail();

        return new LaboratorioRealResource($laboratorio);
    }
}
