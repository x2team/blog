<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')
                    ->latestFirst()
                    ->published()
                    ->filter(request('term'))
                    ->simplePaginate(2);

        return view('blog.index', compact('posts'));
    }

    public function show(Post $post)
    {
        $post->increment('view_count');
        // $post->update()
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

    public function author(User $author)
    {
        $authorName = $author->name;

        // \DB::enableQueryLog();
        $posts = $author->posts()
                        ->with('category')
                        ->latestFirst()
                        ->published()
                        ->simplePaginate(3);

        return view("blog.index", compact('posts', 'authorName'));    
    }
}
