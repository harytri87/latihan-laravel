<?php

namespace App\Providers;

use App\Models\Blog;
use App\Models\User;
use App\Observers\BlogObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        Gate::define('edit-destroy-blog', function (User $user, Blog $blog) {
			return $blog->user->is($user);
		});

        Blog::observe(BlogObserver::class);
    }
}
