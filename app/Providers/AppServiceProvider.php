<?php

namespace App\Providers;

use App\Repositories\ArticleRepository;
use App\Repositories\UserRepository;
use App\Services\ArticleService;
use App\Services\AuthService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ArticleService::class, function ($app) {
            return new ArticleService($app->make(ArticleRepository::class));
        });

        $this->app->bind(AuthService::class, function ($app) {
            return new AuthService($app->make(UserRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
