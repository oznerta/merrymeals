<?php

namespace App\Providers;

use App\Models\Menu;
use App\Policies\MenuPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;;

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
        $this->registerPolicies();

        Gate::define('view-menu', [MenuPolicy::class, 'view']);
        Gate::define('create-menu', [MenuPolicy::class, 'create']);
        Gate::define('update-menu', [MenuPolicy::class, 'update']);
        Gate::define('delete-menu', [MenuPolicy::class, 'delete']);
    }
}
