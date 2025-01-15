<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
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
        View::share('pageTitle', 'New Door Ventures: Your Trusted Partner in Real Estate Solutions');
        View::share('pageKeywords', '');
        View::share('pageDescription', 'When a real estate company prioritizes the “Feet on Street” experience, you expect a unique combination of knowledge, integrity, attention to detail, and reliable realty service and advice. This is precisely what the team at NEW DOOR VENTURES delivers, and their commitment has propelled them to become the leading real estate company in Bangalore. ');
        View::share('ogImage', url('images/general/logo-dark.png'));

        $fullscreenAdvertisement = \App\Models\Advertisement::where('text','full_screen')->select('image','redirection')->get();
        View::share('fullscreenAdvertisement', $fullscreenAdvertisement);

         //
         Blade::if('detect', function () {
            if (!empty($_SERVER['HTTP_USER_AGENT'])) {
                $user_agent = $_SERVER['HTTP_USER_AGENT'];
                if (preg_match('/(Mobile|Android|Tablet|GoBrowser|[0-9]x[0-9]*|uZardWeb\/|Mini|Doris\/|Skyfire\/|iPhone|Fennec\/|Maemo|Iris\/|CLDC\-|Mobi\/)/uis', $user_agent)) {
                    return true; // Output content for mobile
                }
            }
            return false; // Output content for desktop
        });

        $agent = new \Jenssegers\Agent\Agent;
        View::share('agent', $agent);

    }
}
