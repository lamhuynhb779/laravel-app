<?php

namespace App\Providers;

use App\Services\Interfaces\RiakService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class RiakServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Chi nen su dung de bind nhung thu can thiet vao service container
        $this->app->bind(RiakService::class, function () {
            return new \App\Services\RiakService();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Ham nay chi goi sau khi tat ca cac service providers da dang ky thanh cong
    }

    public function provides(): array
    {
        return [RiakService::class];
    }
}
