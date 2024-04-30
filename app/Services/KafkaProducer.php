<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;

class KafkaProducer
{
    public function runProducer()
    {
        try {
            $message = new Message(
                headers: ['xxx' => 'yyyy'],
                body: ['test' => 'Hello Kafka by Lam'],
                key: 'kafka key here',
            );

            Kafka::publishOn('test-topic')
                ->withMessage($message)
                ->send();

        } catch (\Exception $exception) {
            Log::error($exception);
            return response()->json(['status' => false]);
        }

        return response()->json(['status' => true]);
    }
}
