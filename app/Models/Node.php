<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Node extends Model
{
    protected $fillable = [
        'node_name',
        'type',
        'current_value',
        'status',
    ];
}
