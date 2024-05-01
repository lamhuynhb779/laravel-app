<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Log;

class RabbitDispatchJob implements ShouldQueue
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;

    }

    public function handle()
    {
        $data = $this->data;
        Log::info('RabbitDispatchJob@handle Message from RabbitMQ', [
            'data' => $data
        ]);

    }
}
