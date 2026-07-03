<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LaboratorioRealResource;
use App\Models\LaboratorioReal;

class LaboratorioRealController extends Controller
{
    public function show(string $slug)
    {
        $laboratorio = LaboratorioReal::query()
            ->where('slug', $slug)
            ->where('es_visible', true)
            ->with(['documentacion', 'avances', 'adjuntos', 'ideas'])
            ->firstOrFail();

        return new LaboratorioRealResource($laboratorio);
    }
}
