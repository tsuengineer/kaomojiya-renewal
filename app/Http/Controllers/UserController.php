<?php

namespace App\Http\Controllers;

use App\Usecases\User\IndexAction;
use App\Usecases\User\ShowAction;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request, IndexAction $action): View
    {
        $data = $action($request);

        return view('users.index', $data);
    }

    public function show(ShowAction $action, string $slug): View
    {
        $data = $action($slug);

        return view('users.show', $data);
    }

    public function followings(ShowAction $action, string $slug): View
    {
        $data = $action($slug);

        return view('users.followings', $data);
    }

    public function followers(ShowAction $action, string $slug): View
    {
        $data = $action($slug);

        return view('users.followers', $data);
    }
}
