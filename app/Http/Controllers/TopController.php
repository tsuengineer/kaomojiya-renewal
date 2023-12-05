<?php

namespace App\Http\Controllers;

use App\Usecases\Top\IndexAction;
use Illuminate\Contracts\View\View;

class TopController extends Controller
{
    public function index(IndexAction $action): View
    {
        $facemarks = $action();

        return view('top.index', [
            'latestFacemarks' => $facemarks['latestFacemarks'],
            'randomFacemarks' => $facemarks['randomFacemarks'],
        ]);
    }
}
