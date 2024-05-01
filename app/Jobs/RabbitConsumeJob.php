<?php

namespace App\Jobs;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Queue\Jobs\JobName;
use Illuminate\Support\Facades\Log;
use VladimirYuldashev\LaravelQueueRabbitMQ\Queue\Jobs\RabbitMQJob;

class RabbitConsumeJob extends RabbitMQJob
{
    /**
     * Fire the job.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function fire()
    {
        $payload = $this->payload();

        [$class, $method] = JobName::parse($payload['job']);

        ($this->instance = $this->resolve($class))->{$method}($this, $payload['data']);

        Log::info('RabbitConsumeJob@fire Message from RabbitMQ', [
            'payload' => $payload,
            'class' => $class,
            'method' => $method,
        ]);

//        $this->delete();
    }
}
