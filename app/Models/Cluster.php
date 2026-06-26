<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cluster extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'description',
        'status',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function servers(): BelongsToMany
    {
        return $this->belongsToMany(Server::class, 'cluster_server')
            ->withPivot(['id', 'node_role', 'sort_order'])
            ->withTimestamps()
            ->orderBy('cluster_server.sort_order');
    }

    public function clusterServers(): HasMany
    {
        return $this->hasMany(ClusterServer::class)->orderBy('sort_order');
    }
}
