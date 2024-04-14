<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class models extends Model
{
    use HasFactory;

    public function getBrand(): BelongsTo{
        return $this->belongsTo(brands::class, 'brand_id');
    }
}
