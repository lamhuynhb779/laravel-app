<?php

namespace App\Console\Commands\RabbitMQ;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class ConsumerDLXCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consumer:consume_message_dlx';

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

        $NOTI_QUEUE_DLX = 'test-queue-dlx-1';

        $channel->basic_consume(
            $NOTI_QUEUE_DLX,
            '',
            false,
            false,
            false,
            false,
            function ($msg) {
                $now = now()->toDateTimeString();
                echo " [x] Received hotfix = {$msg->body} at $now \n";
                $msg->ack();
            });

        try {
            echo "Consumer hotfix start ... \n";
            $channel->consume();

        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }
}
