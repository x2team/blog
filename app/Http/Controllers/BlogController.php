<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\User;
use App\Tag;

class BlogController extends Controller
{
    public function index()
    {
        $posts = Post::with(['author', 'category', 'tags'])
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
        $posts = $category->posts()
                        ->with('author')
                        ->latestFirst()
                        ->published()
                        ->simplePaginate(3);
        return view("blog.index", compact('posts', 'categoryName'));
    }

    public function author(User $author)
    {
        $authorName = $author->name;
        $posts = $author->posts()
                        ->with(['category', 'tags'])
                        ->latestFirst()
                        ->published()
                        ->simplePaginate(3);
        return view("blog.index", compact('posts', 'authorName'));    
    }

    public function tag(Tag $tag)
    {
        $tagName = $tag->name;
        $posts = $tag->posts()
                        ->with(['category', 'author'])
                        ->latestFirst()
                        ->published()
                        ->simplePaginate(5);

        return view("blog.index", compact('posts', 'tagName'));
    }
}
