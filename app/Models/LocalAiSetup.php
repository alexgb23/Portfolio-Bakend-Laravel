<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LocalAiSetup extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'provider',
        'model_name',
        'model_size',
        'base_url',
        'interface_name',
        'description',
        'hardware_notes',
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
