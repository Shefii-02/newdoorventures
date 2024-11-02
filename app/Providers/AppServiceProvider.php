<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Botble\Location\Repositories\Interfaces\CityInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register any bindings
        $this->app->bind(CityInterface::class, YourCityRepository::class); // Replace YourCityRepository with the actual repository class
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $cityRepository = $this->app->make(CityInterface::class);
        
        $location = '';

        $locations = $cityRepository->filters($location);
        $dropDownLocation = $locations->loadMissing('state');

        view()->share('dropDownLocation', $dropDownLocation);
    }
}
