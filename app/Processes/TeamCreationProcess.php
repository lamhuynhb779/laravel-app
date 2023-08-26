<?php

namespace App\Processes;

use App\Tasks\AssignNewTeamMemberTask;
use App\Tasks\CreateNewTeamTask;

class TeamCreationProcess extends Process
{
    protected $tasks = [
        CreateNewTeamTask::class,
        AssignNewTeamMemberTask::class,
//        NotifyTeamOwnerOfNewMemberTask::class,
//        SetupBillingForTeamTask::class,
    ];
}
