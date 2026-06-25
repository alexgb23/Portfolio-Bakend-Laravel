<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ResearchMetric extends Model
{
    protected $fillable = [
        'research_source_id',
        'metric_name',
        'metric_value',
        'metric_unit',
        'measured_on',
        'notes',
        'status',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'measured_on' => 'date',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function source(): BelongsTo
    {
        return $this->belongsTo(ResearchSource::class, 'research_source_id');
    }
}
