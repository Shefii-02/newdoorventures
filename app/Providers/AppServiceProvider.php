<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton('seohelper', function () {
            return new \App\Class\SeoHelperService();
        });
    
        $this->app->singleton('theme', function () {
            return new \App\Class\ThemeService();
        });
    
        $this->app->singleton('rvmedia', function () {
            return new \App\Class\RvMediaService();
        });
        
       

        
    }
    

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);
    }
}
