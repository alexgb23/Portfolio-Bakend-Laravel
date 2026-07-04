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
            ->withCount(['documentacion', 'avances'])
            ->orderByDesc('es_destacado')
            ->orderBy('orden')
            ->orderByDesc('id')
            ->limit(5)
            ->get();

        return LaboratorioRealHomeResource::collection($laboratorios);
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
