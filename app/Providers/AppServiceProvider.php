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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Tracking query gets executed
//        DB::listen(function ($query) {
//            $location = collect(debug_backtrace())->filter(function ($trace) {
//                if (isset($trace['file'])) {
//                    return !str_contains($trace['file'], 'vendor/');
//                }
//                return false;
//            })->first(); // grab the first element of non vendor/ calls
//            $bindings = implode(',', $query->bindings); // format the bindings as string
//            Log::info("
//            — — — — — —
//            Sql: $query->sql
//            Bindings: $bindings
//            Time: $query->time milliseconds
//            File: ${location['file']}
//            Line: ${location['line']}
//            — — — — — —
//            ");
//        });

//        $this->checkDatabaseConnection();
    }

    private function checkDatabaseConnection() {
        try {
            DB::connection()->getPDO();
            Log::info("Database connected: ".DB::connection()->getDatabaseName());
        }
        catch (\Exception $e) {
            Log::info('Database connected: '.'None');
        }
    }
}
