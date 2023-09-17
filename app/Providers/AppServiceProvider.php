<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Validator::extend('allowed_day', function ($attribute, $value, $parameters, $validator) {
            // Define the allowed days as an array
            $allowedDays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

            // Check if the selected day is in the allowed days
            return in_array(Carbon::parse($value)->format('l'), $allowedDays);
        });

        Validator::replacer('allowed_day', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':attribute', $attribute, 'The selected :attribute is not allowed.');
        });
    }
}
