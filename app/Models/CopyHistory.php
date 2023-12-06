<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CopyHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'facemark_id',
        'accessed_at',
    ];

    public function facemark(): BelongsTo
    {
        return $this->belongsTo(Facemark::class);
    }
}
