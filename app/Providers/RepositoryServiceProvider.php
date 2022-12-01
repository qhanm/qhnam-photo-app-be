<?php

namespace App\Providers;

use App\Http\Repositories\Interfaces\IUserRepository;
use App\Http\Repositories\Interfaces\IPhotoRepository;
use App\Http\Repositories\PhotoRepository;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IUserRepository::class, UserRepository::class);
        $this->app->bind(IPhotoRepository::class, PhotoRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
