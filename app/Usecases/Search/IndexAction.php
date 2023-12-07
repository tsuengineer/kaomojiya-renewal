<?php

namespace App\Usecases\Search;

use App\Models\Facemark;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class IndexAction
{
    public function __invoke(array $searchData): LengthAwarePaginator
    {
        return Facemark::with('user', 'user.avatars')
            ->where(function ($query) use ($searchData) {
                $query->where('data', 'like', "%{$searchData['keyword']}%");
            })
            ->when($searchData['tag'], function ($query) use ($searchData) {
                $query->whereHas('tags', function ($query) use ($searchData) {
                    $query->where('name', $searchData['tag']);
                });
            })
            ->orderBy('created_at', $searchData['order'])
            ->paginate(50);
    }
}
