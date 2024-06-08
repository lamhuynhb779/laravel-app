<?php

namespace App\Console\Commands\RabbitMQ\MessageOrdered;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ProducerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'producer:send_multi';

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
        // 1. Create connection
        $connection = new AMQPStreamConnection('rabbitmq', 5672, 'guest', 'guest');
        $channel = $connection->channel();

        // 2. Create exchange
        $channel->exchange_declare('message-ordered-exchange-1', 'direct', false, true);

        // 3. Create queue
        $channel->queue_declare('message-ordered-queue-1', false, true, false, false);

        // 4. Binding
        $channel->queue_bind(
            'message-ordered-queue-1',
            'message-ordered-exchange-1',
            'message-ordered-routing-key-1'
        );

        // 5. Send messages
        for ($i = 0; $i < 10; $i++) {
            try {
                $msg = new AMQPMessage("A new product {$i}");
                $channel->basic_publish(
                    $msg,
                    'message-ordered-exchange-1',
                    'message-ordered-routing-key-1'
                );
            } catch (\Exception $e) {
                dump($e->getMessage());
            }
        }

        // 6. Close channel/connection
        $channel->close();
        $connection->close();

        echo " [x] Sent successfully \n";
    }
}
