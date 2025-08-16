<?php

namespace App\Providers;

use App\Models\Dashboard;
use App\Policies\DashboardPolicy;
use Illuminate\Support\ServiceProvider;
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
        //
        Gate::policy(Dashboard::class, DashboardPolicy::class);
    }
}
