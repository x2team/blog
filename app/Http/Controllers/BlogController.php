<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function index()
    {
        // \DB::enableQueryLog();
        $posts = Post::with('author')->latestFirst()->simplePaginate(3);

        return view('blog.index', compact('posts'));

        // dd(\DB::getQueryLog());
    }
}
