<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    public static function getLatestFacemarks()
    {
        return static::with('user', 'user.avatars')
            ->orderBy('created_at', 'desc')
            ->limit(20)
            ->get();
    }

    public static function getRandomFacemarksExcluding($facemarkIds)
    {
        return static::with('user', 'user.avatars')
            ->whereNotIn('id', $facemarkIds)
            ->inRandomOrder()
            ->limit(20)
            ->get();
    }

    public function scopeSearchFacemarks(Builder $query, array $searchData)
    {
        return $query->with('user', 'user.avatars')
            ->where(function ($query) use ($searchData) {
                $query->where('data', 'like', "%{$searchData['keyword']}%");
            })
            ->when($searchData['tag'], function ($query) use ($searchData) {
                $query->whereHas('tags', function ($query) use ($searchData) {
                    $query->where('name', $searchData['tag']);
                });
            });
    }
}
