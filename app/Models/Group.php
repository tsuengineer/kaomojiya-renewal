<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function facemarks(): BelongsToMany
    {
        return $this->belongsToMany(Facemark::class, 'facemark_group');
    }
}
