<?php

namespace App\Http\Controllers;

use App\Processes\TeamCreationProcess;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    protected $teamCreationProcess;

    public function __construct(TeamCreationProcess $teamCreationProcess)
    {
        $this->teamCreationProcess = $teamCreationProcess;
    }

    public function index(Request $request)
    {
        $this->teamCreationProcess->run(collect($request->all()));
    }
}
