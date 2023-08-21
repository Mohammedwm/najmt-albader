<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Feature;
use App\Models\Merchant;
use App\Models\Worker;

class HomeController extends Controller
{
    public function index()
    {
        $data['workers'] = Worker::latest()->get();
        $data['features'] = Feature::latest()->get();
        $data['comments'] = Comment::latest()->get();
        return view('front.home', $data);
    }
}
