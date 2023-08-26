<?php

namespace App\Processes;

use Illuminate\Pipeline\Pipeline;

abstract class Process
{
    protected $tasks = [];

    public function run(object $payload)
    {
        return app(Pipeline::class)->send($payload)->through($this->tasks)->thenReturn();
    }
}
