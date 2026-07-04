<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LaboratorioRealHomeResource;
use App\Http\Resources\LaboratorioRealResource;
use App\Models\LaboratorioReal;

class LaboratorioRealController extends Controller
{
    public function home()
    {
        $laboratorios = LaboratorioReal::query()
            ->where('es_visible', true)
            ->withCount(['documentacion', 'avances', 'adjuntos', 'ideas'])
            ->orderByDesc('es_destacado')
            ->orderBy('orden')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        $principal = $laboratorios->first();

        return response()->json([
            'featured' => LaboratorioRealHomeResource::collection($laboratorios),
            'selected' => $principal ? new LaboratorioRealHomeResource($principal) : null,
        ]);
    }

    public function index()
    {
        $laboratorios = LaboratorioReal::query()
            ->where("es_visible", true)
            ->with(["documentacion", "avances", "adjuntos", "ideas"])
            ->orderBy("orden")
            ->orderByDesc("id")
            ->get();

        return LaboratorioRealResource::collection($laboratorios);
    }

    public function show(string $slug)
    {
        $laboratorio = LaboratorioReal::query()
            ->where("slug", $slug)
            ->where("es_visible", true)
            ->with(["documentacion", "avances", "adjuntos", "ideas"])
            ->firstOrFail();

        return new LaboratorioRealResource($laboratorio);
    }
}
