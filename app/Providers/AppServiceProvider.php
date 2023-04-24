<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function () {
            Filament::registerViteTheme('resources/css/app.css');
        });

        Filament::registerRenderHook('head.start', function () {
            $favicon = Vite::asset('resources/images/jovi_favicon.png');
            return new HtmlString("<link rel='icon' type='image/x-icon' href='$favicon'/>");
        });
    }
}
