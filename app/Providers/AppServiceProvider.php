<?php

namespace App\Providers;

use App\Models\Address;
use App\Models\Contacts;
use App\Models\ProvidedServices;
use App\Models\User;
use App\Policies\AddressPolicy;
use App\Policies\ContactsPolicy;
use App\Policies\ProvidedServicePolicy;
use Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        if ($this->app->isLocal()) {
            $this->app->register(IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('authorize-user', function (User $user) {
            return $user->hasRole(1);
        });

        Gate::policy(ProvidedServices::class, ProvidedServicePolicy::class);
        Gate::policy(Address::class, AddressPolicy::class);
        Gate::policy(Contacts::class, ContactsPolicy::class);
    }
}
