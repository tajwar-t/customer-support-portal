<?php

namespace App\Providers;

use App\Models\Chat;
use App\Models\Post;
use App\Models\Comment;
use App\Policies\ChatPolicy;
use App\Policies\PostPolicy;
use App\Policies\CommentPolicy;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::policy(Chat::class, ChatPolicy::class);
        Gate::policy(Post::class, PostPolicy::class);
        Gate::policy(Comment::class, CommentPolicy::class);
    }
}
