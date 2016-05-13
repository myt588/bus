<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Validator;
use App\Station;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Validator::extend('after_equal', function($attribute, $value, $parameters, $validator) {
            return strtotime($validator->getData()[$parameters[0]]) <= strtotime($value);
         });
         Validator::extend('same_city', function($attribute, $value, $parameters, $validator) {
            return Station::findOrFail($value)->city->id == $validator->getData()[$parameters[0]];
         });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
