<?php

namespace App\Usecases\Search;

use App\Models\Facemark;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexAction
{
    public function __invoke(array $searchData): LengthAwarePaginator
    {
        return Facemark::with('user', 'user.avatars')
            ->withCount('favorites')
            ->where(function ($query) use ($searchData) {
                $query->where('data', 'like', "%{$searchData['keyword']}%");
            })
            ->when($searchData['tag'], function ($query) use ($searchData) {
                $query->whereHas('tags', function ($query) use ($searchData) {
                    $query->where('name', $searchData['tag']);
                });
            })
            ->when($searchData['userSlug'] && !$searchData['filterByFavorite'], function ($query) use ($searchData) {
                $query->whereHas('user', function ($query) use ($searchData) {
                    $query->where('slug', $searchData['userSlug']);
                });
            })
            ->when($searchData['userSlug'] && $searchData['filterByFavorite'], function ($query) use ($searchData) {
                $query->whereHas('favorites', function ($query) use ($searchData) {
                    $query->where('user_id', function ($query) use ($searchData) {
                        $query->select('id')->from('users')->where('slug', $searchData['userSlug']);
                    });
                });
            })
            ->orderBy('created_at', $searchData['order'])
            ->paginate(50);
    }
}
