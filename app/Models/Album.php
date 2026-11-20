<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['band_id', 'name','image','release_date'])]

class Album extends Model
{
    public function band(): BelongsTo
    {
        return $this->belongsTo(Band::class);
    }
}
