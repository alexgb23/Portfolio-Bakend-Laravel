<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AdjuntoLaboratorio extends Model
{
    protected $table = "adjuntos_laboratorio";

    protected $fillable = [
        "laboratorio_real_id",
        "seccion",
        "fase",
        "tipo_adjunto",
        "storage_driver",
        "url",
        "urls_relacionadas",
        "nombre_archivo",
        "mime_type",
        "descripcion",
        "resumen_ia",
        "origen",
        "metadata",
        "orden",
    ];

    protected function casts(): array
    {
        return [
            "laboratorio_real_id" => "integer",
            "urls_relacionadas" => "array",
            "metadata" => "array",
            "orden" => "integer",
        ];
    }

    public function laboratorioReal(): BelongsTo
    {
        return $this->belongsTo(LaboratorioReal::class, "laboratorio_real_id");
    }
}
