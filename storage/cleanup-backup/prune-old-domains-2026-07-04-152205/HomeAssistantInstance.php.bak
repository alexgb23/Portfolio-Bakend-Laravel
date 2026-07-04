<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class HomeAssistantInstance extends Model
{
    protected $fillable = [
        "name",
        "slug",
        "version",
        "location_name",
        "access_url",
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

    public function useCases(): HasMany
    {
        return $this->hasMany(HomeAssistantUseCase::class)
            ->where("is_visible", true)
            ->orderByDesc("is_featured")
            ->orderBy("sort_order");
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
        return $query->orderBy("sort_order")->orderBy("name");
    }
}
