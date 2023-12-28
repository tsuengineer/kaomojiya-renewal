<?php

namespace App\Http\Controllers;

use App\Usecases\Search\IndexAction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SearchController extends Controller
{
    public function index(Request $request, IndexAction $action): view
    {
        $searchData = [
            'keyword' => $request->input('keyword'),
            'tag' => $request->input('tag'),
            'userSlug' => $request->input('user_slug'),
            'filterByFavorite' =>  $request->input('filter_by_favorite', '0'),
            'order' => match ($request->input('order')) {
                'asc' => 'asc',
                default => 'desc',
            },
        ];

        $facemarks = $action($searchData);

        return view('search.index', compact('facemarks', 'searchData'));
    }
}
