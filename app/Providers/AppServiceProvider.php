<?php

namespace App\Providers;

use App\Food2ForkClient;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        auth()->login(\App\Models\User::first());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Food2ForkClient::class, function () {
            return new Food2ForkClient(env('FOOD2FORK_API_KEY'));
        });
    }
}
