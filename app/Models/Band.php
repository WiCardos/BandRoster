<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name','photo'])]

class Band extends Model
{
    public function albums(): HasMany
    {
        return $this->hasMany(Album::class);
    }
}
