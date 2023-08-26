<?php

namespace App\Tasks;

use App\Console\Commands\CreateNewTeamCommand;

class CreateNewTeamTask
{
    protected $command;

    public function __construct(CreateNewTeamCommand $command)
    {
        $this->command = $command;
    }

    public function __invoke(object $payload, \Closure $next)
    {
        $this->command->handle($payload);

        return $next($payload);
    }
}
