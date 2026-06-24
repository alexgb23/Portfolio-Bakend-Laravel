<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabCapability extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'capability_level',
        'description',
        'technical_notes',
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
