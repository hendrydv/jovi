<?php

namespace App\Providers;

use Illuminate\Support\HtmlString;
use Illuminate\Support\ServiceProvider;
use Filament\Facades\Filament;
use Vite;

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

        $test = Vite::asset('resources/images/jovi_favicon.png');

        Filament::pushMeta([
            new HtmlString("<link rel='icon' type='image/x-icon' href='$test'/>"),
        ]);
    }
}
