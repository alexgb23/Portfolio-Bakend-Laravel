<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeAssistantUseCase extends Model
{
    protected $fillable = [
        'home_assistant_instance_id',
        'title',
        'category',
        'description',
        'status',
        'is_featured',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_visible' => 'boolean',
    ];

    public function instance(): BelongsTo
    {
        return $this->belongsTo(HomeAssistantInstance::class, 'home_assistant_instance_id');
    }
}
