<?php

namespace App\Console\Commands\RabbitMQ;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ConsumerProcessFailedCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consumer:process_failed';

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
     * @throws \Exception
     */
    public function handle(): void
    {
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        $channel->basic_consume(
            'test-queue-1',
            '',
            false,
            false,
            false,
            false,
            function (AMQPMessage $msg) {
                try {
                    throw new \Exception("Processing failed!!! \n");
                    $msg->ack();
                } catch (\Exception $e) {
                    echo $e->getMessage();
                    // message will be added back to the queue
                    $msg->nack(false, false);
                }
            }
        );

        try {
            echo "Consumer with processing error start ... \n";
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }
}
