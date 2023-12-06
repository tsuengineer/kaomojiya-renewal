<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facemark extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'ulid',
        'data',
        'copy_count',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'facemark_tag');
    }

    public function groups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class, 'facemark_group');
    }

    public function copyHistories(): HasMany
    {
        return $this->hasMany(CopyHistory::class);
    }
}
