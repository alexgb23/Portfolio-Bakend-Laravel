<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AvanceLaboratorio extends Model
{
    protected $table = "avances_laboratorio";

    protected $fillable = [
        "laboratorio_real_id",
        "titulo",
        "resumen",
        "descripcion",
        "fase",
        "seccion",
        "tipo_avance",
        "estado",
        "fecha_avance",
        "urls_relacionadas",
        "metadata",
    ];

    protected function casts(): array
    {
        return [
            "laboratorio_real_id" => "integer",
            "fecha_avance" => "datetime",
            "urls_relacionadas" => "array",
            "metadata" => "array",
        ];
    }

    public function laboratorioReal(): BelongsTo
    {
        return $this->belongsTo(LaboratorioReal::class, "laboratorio_real_id");
    }
}
