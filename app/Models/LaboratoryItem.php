<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LaboratoryItem extends Model
{
    protected $guarded = [];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_visible' => 'boolean',
    ];
}
