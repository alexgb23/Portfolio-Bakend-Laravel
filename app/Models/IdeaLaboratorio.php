<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IdeaLaboratorio extends Model
{
    protected $table = "ideas_laboratorio";

    protected $fillable = [
        "laboratorio_real_id",
        "titulo",
        "idea",
        "detalle",
        "fase",
        "seccion",
        "estado",
        "prioridad",
        "origen",
        "creada_por_ia",
        "urls_relacionadas",
        "metadata",
    ];

    protected function casts(): array
    {
        return [
            "laboratorio_real_id" => "integer",
            "creada_por_ia" => "boolean",
            "urls_relacionadas" => "array",
            "metadata" => "array",
        ];
    }

    public function laboratorioReal(): BelongsTo
    {
        return $this->belongsTo(LaboratorioReal::class, "laboratorio_real_id");
    }
}
