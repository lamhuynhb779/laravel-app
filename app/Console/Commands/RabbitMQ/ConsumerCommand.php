<?php

namespace App\Console\Commands\RabbitMQ;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class ConsumerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consumer:consume_message';

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

        $NOTI_QUEUE = 'test-queue-1';

        $callback = function ($msg) {
            $now = now()->toDateTimeString();
            echo " [x] Received normal = {$msg->body} at $now \n";
            $msg->ack();
        };

        // This tells RabbitMQ not to give more than one message to a worker at a time.
        $channel->basic_qos(null, 1, false);

        $channel->basic_consume($NOTI_QUEUE, '', false, false, false, false, $callback);

        try {
            echo "Consumer normal start ... \n";
//            $channel->consume();
            while(count($channel->callbacks)) {
                // inspect the queue and call the corresponding callbacks
                //passing the message as a parameter
                $channel->wait();
            }

        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }
}
