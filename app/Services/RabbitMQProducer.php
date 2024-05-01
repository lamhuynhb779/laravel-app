<?php

namespace App\Services;

use App\Jobs\RabbitDispatchJob;
use Illuminate\Support\Facades\Log;

class RabbitMQProducer
{
    public function runProducer(array $data)
    {
        try {
            dispatch(new RabbitDispatchJob($data));

            return response()->json(['status' => true]);

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());

            return response()->json(['status' => false]);
        }
    }
}
