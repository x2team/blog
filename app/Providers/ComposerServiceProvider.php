<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
//bee them vao
use Illuminate\Support\Facades\View;
use App\Category;
use App\Post;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.sidebar', function($view){
            $categories = Category::with(['posts' => function($query){
                $query->published();
            }])->orderBy('title', 'asc')->get();

            return $view->with('categories', $categories);
        });


        View::composer('layouts.sidebar', function($view){

            $popularPosts = Post::published()->popular()->take(3)->get();

            return $view->with('popularPosts', $popularPosts);
        });

    }
}
