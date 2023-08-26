<?php

namespace App\Tasks;

use App\Console\Commands\AssignNewTeamMemberCommand;

class AssignNewTeamMemberTask
{
    protected $command;

    public function __construct(AssignNewTeamMemberCommand $command)
    {
        $this->command = $command;
    }

    public function __invoke(object $payload, \Closure $next)
    {
        $this->command->handle($payload);

        return $next($payload);
    }
}
