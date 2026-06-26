<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        "name",
        "email",
        "subject",
        "message",
        "status",
        "read_at",
    ];

    protected $casts = [
        "read_at" => "datetime",
    ];

    public function scopeUnread(Builder $query): Builder
    {
        return $query->whereNull("read_at");
    }

    public function scopeRead(Builder $query): Builder
    {
        return $query->whereNotNull("read_at");
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->latest("created_at");
    }
}
