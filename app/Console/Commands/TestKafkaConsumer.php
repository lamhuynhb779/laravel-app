<?php

namespace App\Console\Commands;

use App\Handlers\TestHandler;
use Carbon\Exceptions\Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Junges\Kafka\Contracts\KafkaConsumerMessage;
use Junges\Kafka\Facades\Kafka;

class TestKafkaConsumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kafka:test-consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        try {
            $consumer = Kafka::createConsumer()
                ->subscribe('test-topic')
                ->withHandler(new TestHandler)
                ->withAutoCommit()
                ->withConsumerGroupId('test-consumer')
                ->build();

            $consumer->consume();

        } catch (Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
