<?php

namespace App\Providers;
use App\Services\FilteredBookService;
use Illuminate\Support\ServiceProvider;


class BookServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    public function register(): void
    {
        $this->app->singleton(FilteredBookService::class, function ($app) {
            return new FilteredBookService();
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
