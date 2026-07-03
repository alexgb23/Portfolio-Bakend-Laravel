<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DocumentacionLaboratorio extends Model
{
    protected $table = "documentacion_laboratorio";

    protected $fillable = [
        "laboratorio_real_id",
        "fase",
        "seccion",
        "tipo_documentacion",
        "titulo",
        "resumen",
        "contenido",
        "urls_relacionadas",
        "orden",
        "estado",
        "es_visible",
        "origen",
        "metadata",
    ];

    protected function casts(): array
    {
        return [
            "laboratorio_real_id" => "integer",
            "urls_relacionadas" => "array",
            "orden" => "integer",
            "es_visible" => "boolean",
            "metadata" => "array",
        ];
    }

    public function laboratorioReal(): BelongsTo
    {
        return $this->belongsTo(LaboratorioReal::class, "laboratorio_real_id");
    }
}
