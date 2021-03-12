<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\TestLog;
use Carbon\Carbon;

class TestJobsController extends Controller 
{
    public function index() 
    {
        $job = new TestLog();
        // $job->onQueue('write_log_file')->delay(now()->addMinutes(10));
        // $job->onQueue('write_log_file')->delay(Carbon::now()->addSecond(60));

        // specify the queue name or use default queue name
        $job->onQueue('write_log_file');

        dispatch($job);
        return view('testJobs/index');
    }

    public function logUser() 
    {
        $job = new TestLog(\Auth::user());
        dispatch($job);
        return view('testJobs/log_user');
    }
}