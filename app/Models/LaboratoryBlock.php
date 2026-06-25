<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaboratoryBlock extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'block_key',
        'kicker',
        'title',
        'description',
        'layout_type',
        'status',
        'is_visible',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
        'is_featured' => 'boolean',
        'sort_order' => 'integer',
    ];
}
