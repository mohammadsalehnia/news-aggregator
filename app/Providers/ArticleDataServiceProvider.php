<?php

namespace App\Providers;

use App\Services\ArticleDataProvider\ArticleDataProviderInterface;
use App\Services\ArticleDataProvider\NewsAPIDataProvider;
use Illuminate\Support\ServiceProvider;

class ArticleDataServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ArticleDataProviderInterface::class, function ($app) {
            return new NewsAPIDataProvider();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
