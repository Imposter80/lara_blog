<?php

namespace App\Providers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Cache;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
        view()->composer('layouts.sidebar', function ($view) {
            if (Cache::has('categories')) {
                $categories = Cache::get('categories');
            } else {
                $categories = Category::withCount('posts')->orderBy('posts_count', 'desc')->get();
                Cache::put('categories', $categories, 30);
            }
            if (Cache::has('tags')) {
                $tags = Cache::get('tags');
            } else {
                $tags = Tag::withCount('posts')->orderBy('posts_count', 'desc')->get();
                Cache::put('tags', $tags, 30);
            }

            $view->with('popular_posts', Post::orderBy('views', 'desc')->limit(4)->get());
            $view->with('categories', $categories)->with( 'tags', $tags);
        });
        view()->composer('posts.index', function ($view) {
            $view->with('last_posts', Post::orderBy('created_at', 'desc')->limit(1)->get());
        });

    }
}
