<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Book;
use App\Policies\BookPolicy;


class AppServiceProvider extends ServiceProvider
{
    protected $policies = [
        \App\Models\Book::class => \App\Policies\BookPolicy::class,
        \App\Models\User::class => \App\Policies\UserPolicy::class,

    ];
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
    }
}
