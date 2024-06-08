<?php

namespace App\Console\Commands\RabbitMQ\MessageOrdered;

use Illuminate\Console\Command;
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class ConsumerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'consumer:consume_message_ordered';

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

        // method to make it possible to limit the number of unacknowledged messages on a channel (or connection)
        // when consuming (aka "prefetch count")
        // prefetch_count = 1 : per consumer limit
        // prefetch_count = 0 : No limit for this consumer
        // global = true: apply cho toàn bộ consumers trong channel này
        // global = false: apply tách biệt riêng từng consumer
        // Ví dụ:
        // $channel->basic_qos(null, 10, false); // Per consumer limit: mỗi consumer nhận được tối đa 10 unack messages
        // $channel->basic_qos(null, 15, true);  // Per channel limit: tổng số unack messages của cả 2 consumers là 15
        $channel->basic_qos(null, 1, false);

        // 2. Define queue for consumer
        $channel->basic_consume(
            'message-ordered-queue-1',
            '',
            false,
            false,
            false,
            false,
            function (AMQPMessage $msg) {
                $delay = rand(0, 10) / 10;
                dump($delay);
//                sleep($delay * 2000);
                echo " [x] Received normal = {$msg->body} \n";
                $msg->ack();
            }
        );

        // 3. Consuming
        try {
            echo "Consumer processing start ... \n";
            $channel->consume();
        } catch (\Throwable $exception) {
            echo $exception->getMessage();
        }
    }
}
