<?php

namespace App\Console\Commands\RabbitMQ;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
use PhpAmqpLib\Wire\AMQPTable;

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
        // Enabling Publisher Confirms on a Channel to make sure published messages have safely reached the broker
//        $channel->confirm_select();

        $NOTI_EXCHANGE = 'test-exchange-1';
        $NOTI_QUEUE = 'test-queue-1';
        $NOTI_ROUTING_KEY = 'test-routing-key-1';

        $NOTI_EXCHANGE_DLX = 'test-exchange-dlx-1';
        $NOTI_QUEUE_DLX = 'test-queue-dlx-1';
        $NOTI_ROUTING_KEY_DLX = 'test-routing-key-dlx-1';

        // 2. Create exchange
        $channel->exchange_declare($NOTI_EXCHANGE, 'direct', false, true);
        $channel->exchange_declare($NOTI_EXCHANGE_DLX, 'direct', false, true);

        // 3. Create queue
        $channel->queue_declare(
            $NOTI_QUEUE,
            false,
            true,
            false,
            false,
            false,
            new AMQPTable([
                'x-dead-letter-exchange' => $NOTI_EXCHANGE_DLX,
                'x-dead-letter-routing-key' => $NOTI_ROUTING_KEY_DLX,
                'x-message-ttl' => 5000,
            ])
        );
        $channel->queue_declare($NOTI_QUEUE_DLX, false, true, false, false);

        // 4. Binding
        $channel->queue_bind($NOTI_QUEUE, $NOTI_EXCHANGE, $NOTI_ROUTING_KEY);
        $channel->queue_bind($NOTI_QUEUE_DLX, $NOTI_EXCHANGE_DLX, $NOTI_ROUTING_KEY_DLX);

        $now = now()->toDateTimeString();
        $msg = new AMQPMessage("A new product at $now", [
//            'expiration' => 2000,
            'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT,
        ]);

        try {
            $channel->basic_publish($msg, $NOTI_EXCHANGE, $NOTI_ROUTING_KEY);
//            $channel->wait_for_pending_acks(-1);
        } catch (\Exception $e) {
//            $err = $e->getMessage();
//            echo " Exception timeout waiting for confirm message::$err \n";
        }

        $channel->close();
        $connection->close();

        echo " [x] Sent successfully at $now \n";
    }
}
