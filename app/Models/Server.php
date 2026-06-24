<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Server extends Model
{
    public function clusters(): BelongsToMany
    {
        return $this->belongsToMany(Cluster::class, 'cluster_server')
            ->withPivot(['id', 'node_role', 'sort_order'])
            ->withTimestamps();
    }
}
