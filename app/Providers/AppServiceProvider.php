<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Schema;
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
        Blade::include('components.form.radio', 'form_radio');
        Blade::include('components.form.button', 'form_button');
        Blade::include('components.form.select', 'form_select');
        Blade::include('components.table', 'table');
        Schema::defaultStringLength(191);
    }
}
