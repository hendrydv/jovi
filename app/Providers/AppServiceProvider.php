<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;

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

        $favicon = Vite::asset('resources/images/jovi_favicon.png');

        Filament::pushMeta([
            new HtmlString("<link rel='icon' type='image/x-icon' href='$favicon'/>"),
        ]);
    }
}
