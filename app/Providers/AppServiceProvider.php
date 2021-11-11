<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application service.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application service.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('bd_mobile', function ($attribute, $value, $parameters, $validator) {
            return preg_match('/^(01)[1-9]{1}[0-9]{8}$/', $value);
        });

    }
}
