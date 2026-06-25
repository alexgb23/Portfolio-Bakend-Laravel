<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaboratoryItem extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'item_type',
        'category',
        'location_name',
        'status',
        'description',
        'technical_notes',
        'is_featured',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_visible' => 'boolean',
        'sort_order' => 'integer',
    ];
}
