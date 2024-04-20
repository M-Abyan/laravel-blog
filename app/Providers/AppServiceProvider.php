<?php

namespace App\Providers;

use App\Policies\CommentPolicy;
use Illuminate\Support\ServiceProvider;
use App\Policies\PostPolicy;
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
        Gate::define('update-post', [PostPolicy::class, 'update']);
        Gate::define('delete-post', [PostPolicy::class, 'delete']);
        Gate::define('update-comment', [CommentPolicy::class, 'update']);
        Gate::define('delete-comment', [CommentPolicy::class, 'delete']);
    }
}
