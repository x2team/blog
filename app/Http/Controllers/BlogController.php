<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class BlogController extends Controller
{
    public function index()
    {
        // \DB::enableQueryLog();
        $posts = Post::with('author')
                    ->latestFirst()
                    ->published()
                    ->simplePaginate(3);

        return view('blog.index', compact('posts'));

        // dd(\DB::getQueryLog());
    }

    public function show(Post $post)
    {
        //$post = Post::findOrFail($id);

        return view('blog.show', compact('post'));
    }
}
