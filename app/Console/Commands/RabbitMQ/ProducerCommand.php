<?php

namespace App\Console\Commands\RabbitMQ;

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
    protected $signature = 'producer:send_message';

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
        $channel->exchange_declare('test-exchange-1', 'direct');

        // 3. Create queue
        $channel->queue_declare('test-queue-1', false, false, false, false);

        // 4. Binding
        $channel->queue_bind('test-queue-1', 'test-exchange-1', 'test-routing-key-1');

        $msg = new AMQPMessage('A new product');
        $channel->basic_publish($msg, 'test-exchange-1', 'test-routing-key-1');

        $channel->close();
        $connection->close();

        echo " [x] Sent successfully'\n";
    }
}
