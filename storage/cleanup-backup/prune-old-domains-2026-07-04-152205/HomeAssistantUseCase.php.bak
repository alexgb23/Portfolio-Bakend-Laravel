<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class HomeAssistantUseCase extends Model
{
    protected $fillable = [
        "home_assistant_instance_id",
        "title",
        "category",
        "description",
        "status",
        "is_featured",
        "is_visible",
        "sort_order",
    ];

    protected $casts = [
        "is_featured" => "boolean",
        "is_visible" => "boolean",
        "sort_order" => "integer",
    ];

    public function instance(): BelongsTo
    {
        return $this->belongsTo(HomeAssistantInstance::class, "home_assistant_instance_id");
    }

    public function scopeVisible(Builder $query): Builder
    {
        return $query->where("is_visible", true);
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where("is_featured", true);
    }

    public function scopeActive(Builder $query): Builder
    {
        return $query->where("status", "active");
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy("sort_order")->orderBy("title");
    }
}
