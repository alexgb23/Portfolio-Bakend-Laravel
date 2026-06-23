<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LaboratoryItem extends Model
{
    protected $guarded = [];

    public function block(): BelongsTo
    {
        return $this->belongsTo(LaboratoryBlock::class, 'laboratory_block_id');
    }
}
