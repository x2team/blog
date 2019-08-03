<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;

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
        return view('blog.show', compact('post'));
    }

    public function category(Category $category)
    {
        $categoryName = $category->title;

        // \DB::enableQueryLog();
        $posts = $category->posts()
                        ->with('author')
                        ->latestFirst()
                        ->published()
                        ->simplePaginate(3);

        // dd(\DB::getQueryLog);
        return view("blog.index", compact('posts', 'categoryName'));

        //  dd(\DB::getQueryLog());
    }
}
