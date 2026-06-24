<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'short_description',
        'technologies',
        'stack_summary',
        'image_url',
        'project_url',
        'repo_url',
        'status',
        'is_featured',
        'is_published',
        'sort_order',
    ];
}
