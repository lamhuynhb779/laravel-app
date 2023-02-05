<?php

namespace App\Jobs\Orders;

use App\Jobs\Job;
use App\Models\Orders;

class CreateOrderJob extends Job
{
    /**
     * CreateOrderJob constructor.
     *
     */
    public function __construct () {
    }

    public function handle()
    {
        Orders::create(['name' => 'order 2']);
    }
}
