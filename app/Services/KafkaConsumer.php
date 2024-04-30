<?php

namespace App\Services;

use Carbon\Exceptions\Exception;
use Illuminate\Support\Facades\Log;
use Junges\Kafka\Facades\Kafka;

class KafkaConsumer
{
    public function runConsumer()
    {
        try {
            $consumer = Kafka::createConsumer()
                ->subscribe('test-topic')
                ->withHandler(function (\Junges\Kafka\Contracts\KafkaConsumerMessage $message) {
                    // handle your message here
                    Log::debug('Kafka consume API data!', [
                        'body' => $message->getBody(),
                        'headers' => $message->getHeaders(),
                        'partition' => $message->getPartition(),
                        'key' => $message->getKey(),
                        'topic' => $message->getTopicName()
                    ]);
                })
                ->withAutoCommit()
                ->withConsumerGroupId('test-consumer')
                ->build();

            $consumer->consume();

        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
