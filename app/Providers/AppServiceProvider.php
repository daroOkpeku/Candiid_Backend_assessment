<?php

namespace App\Providers;

use App\Http\Repository\AuthRepository;
use App\Http\Repository\Contracts\AuthRespositoryinterface;
use Illuminate\Support\ServiceProvider;
use App\Http\Repository\Contracts\PostRespositoryinterface;
use App\Http\Repository\PostRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(PostRespositoryinterface::class, PostRepository::class);
        $this->app->bind(AuthRespositoryinterface::class, AuthRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
