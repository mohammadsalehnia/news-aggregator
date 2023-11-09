<?php

namespace App\Providers;

use App\Services\ArticleDataProvider\ArticleDataProviderInterface;
use App\Services\ArticleDataProvider\NewsAPIDataProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->bind(ArticleDataProviderInterface::class, function ($app) {
//            // Default implementation can be any, you can change it based on your logic
//            return new NewsAPIDataProvider();
//        });
//
//        $this->app->when(NewsAPIDataController::class)
//            ->needs(ArticleDataProviderInterface::class)
//            ->give(function ($app) {
//                return app(NewsAPIDataProvider::class);
//            });
//
//        $this->app->when(NewYorkTimesDataController::class)
//            ->needs(ArticleDataProviderInterface::class)
//            ->give(function ($app) {
//                return app(NewYorkTimesDataProvider::class);
//            });
//
//        $this->app->when(TheGuardianDataController::class)
//            ->needs(ArticleDataProviderInterface::class)
//            ->give(function ($app) {
//                return app(TheGuardianDataProvider::class);
//            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
