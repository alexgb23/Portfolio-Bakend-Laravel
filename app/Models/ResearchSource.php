<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ResearchSource extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'source_type',
        'author_name',
        'publisher_name',
        'published_on',
        'url',
        'reference_code',
        'summary',
        'notes',
        'topic',
        'status',
        'is_featured',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'published_on' => 'date',
        'is_featured' => 'boolean',
        'is_visible' => 'boolean',
    ];

    public function metrics(): HasMany
    {
        return $this->hasMany(ResearchMetric::class)
            ->where('status', 'active')
            ->orderByDesc('is_featured')
            ->orderBy('sort_order');
    }
}
