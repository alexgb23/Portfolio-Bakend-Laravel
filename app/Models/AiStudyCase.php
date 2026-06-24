<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AiStudyCase extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'technology_stack',
        'context',
        'challenge',
        'solution',
        'results',
        'status',
        'is_featured',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_visible' => 'boolean',
    ];
}
