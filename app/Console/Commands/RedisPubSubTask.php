<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RedisPubSubTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:pubsub';

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
     * @throws \RedisException
     */
    public function handle(): void
    {
        $this->info('Redis Pub Sub Start...');

        $redis = new \Redis();
        $redis->connect('redis', '6379');
        $redis->setOption(\Redis::OPT_READ_TIMEOUT, -1);

        $pattern = '__keyevent@12__:expired';

        $this->info(PHP_EOL.' Connect Success...');
        $this->info(PHP_EOL.' Start Subscribe...');

        $redis->psubscribe([$pattern], function ($message, $pattern, $channel, $payload) {
            echo PHP_EOL."Het han";
        });
    }
}
