<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Tracking query gets executed
        DB::listen(function ($query) {
            $location = collect(debug_backtrace())->filter(function ($trace) {
                return isset($trace['file']) && !str_contains($trace['file'], 'vendor/');
            })->first(); // grab the first element of non vendor/ calls
            $bindings = implode(',', $query->bindings); // format the bindings as string
            $file = $location['file'] ?? '';
            $line = $location['line'] ?? '';
            Log::info("
            — — — — — —
            Sql: $query->sql
            Bindings: $bindings
            Time: $query->time milliseconds
            File: $file
            Line: $line
            — — — — — —
            ");
        });
    }
}
