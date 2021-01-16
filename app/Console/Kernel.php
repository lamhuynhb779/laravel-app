<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
// use App\Console\Commands\SendEmailsCommand;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        // This place is to declare command class will be used
        //Commands\Inspire::class,
        Commands\DemoCron::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();

        /**
         * Schedule a closure to be called every day at midnight
         */
        //$schedule->call(function(){
            /**
             * Execute a database query to clear a table
             */
            //DB::table('recent_users')->delete();
        // })->daily();
        
        /**
         * In addition to scheduling using closures, you may also schedule invokable objects. 
         * Invokable objects are simple PHP classes that contain an __invoke method
         */
        // $schedule->call(new DeleteRecentUsers)->daily();

        /**
         * In addition to scheduling closures, you may also schedule Artisan commands and system commands. 
         * For example, you may use the command method to schedule an Artisan command using either the command's name or class.
         * When scheduling Artisan commands using the command's class name, you may pass an array of additional command-line 
         * arguments that should be provided to the command when it is invoked:
         */

        /**
         * The first way
         */
        // $schedule->command('emails:send Taylor --force')->daily();

        /**
         * The second way
         */ 
        // $schedule->command(SendEmailsCommand::class, ['Taylor', '--force'])->daily();

        //$schedule->command('inspire')->hourly();
        $schedule->command('demo:cron')->timezone('Asia/Ho_Chi_Minh')->everyMinute();

        /**
         * Between Time Constraints
         * The between method may be used to limit the execution of a task based on the time of day
         */
        // $schedule->command('reminders:send')
        //             ->hourly()
        //             ->between('7:00', '22:00');

        /**
         * Similarly, the unlessBetween method can be used to exclude the execution of a task for a period of time:
         */
        // $schedule->command('reminders:send')
        //             ->hourly()
        //             ->unlessBetween('23:00', '4:00');

        /**
         * Truth Test Constraints
         * The when method may be used to limit the execution of a task based on the result of a given truth test. 
         * In other words, if the given Closure returns true, the task will execute as long as no other constraining 
         * conditions prevent the task from running:
         */
        // $schedule->command('emails:send')->daily()->when(function () {
        //     return true;
        // });

        /**
         * The skip method may be seen as the inverse of when. 
         * If the skip method returns true, the scheduled task will not be executed:
         */
        // $schedule->command('emails:send')->daily()->skip(function () {
        //     return true;
        // });

        /**
         * Environment Constraints
         * The environments method may be used to execute tasks only on the given environments:
         */
        // $schedule->command('emails:send')
        //     ->daily()
        //     ->environments(['staging', 'production']);

        /**
         * Timezones
         * Using the timezone method, you may specify that a scheduled task's time should be interpreted within a given timezone:
         */
        // $schedule->command('report:generate')
        //  ->timezone('America/New_York')
        //  ->at('02:00');

        /**
         * Preventing Task Overlaps
         * By default, scheduled tasks will be run even if the previous instance of the task is still running. 
         * To prevent this, you may use the withoutOverlapping method: (By default, the lock will expire after 24 hours)
         */
        // $schedule->command('emails:send')->withoutOverlapping();
        // Or $schedule->command('emails:send')->withoutOverlapping(10);

        /**
         * Running Tasks On One Server
         * If your application is running on multiple servers, you may limit a scheduled job to only execute on a single server. 
         * For instance, assume you have a scheduled task that generates a new report every Friday night. 
         * If the task scheduler is running on three worker servers, the scheduled task will run on all three servers and generate
         * the report three times. Not good!
         * To indicate that the task should run on only one server, use the onOneServer method when defining the scheduled task. 
         * The first server to obtain the task will secure an atomic lock on the job to prevent other servers from running the same 
         * task at the same time:
         */
        // $schedule->command('report:generate')
        //         ->fridays()
        //         ->at('17:00')
        //         ->onOneServer();

        /**
         * Background Tasks
         * By default, multiple commands scheduled at the same time will execute sequentially. 
         * If you have long-running commands, this may cause subsequent commands to start much later than anticipated. 
         * If you would like to run commands in the background so that they may all run simultaneously, you may use the 
         * runInBackground method
         */
        // $schedule->command('analytics:report')
        //  ->daily()
        //  ->runInBackground();

        /**
         * Maintenance Mode
         */
        // $schedule->command('emails:send')->evenInMaintenanceMode();

        /**
         * Task Output
         */
        // $schedule->command('emails:send')
        //  ->daily()
        //  ->sendOutputTo($filePath);

        // Or append
        // $schedule->command('emails:send')
        //  ->daily()
        //  ->appendOutputTo($filePath);

        // Before e-mailing the output of a task, you should configure `Laravel's e-mail services`:
        // $schedule->command('foo')
        //  ->daily()
        //  ->sendOutputTo($filePath)
        //  ->emailOutputTo('foo@example.com');

        // If you only want to e-mail the output if the command fails, use the emailOutputOnFailure method:
        // $schedule->command('foo')
        // ->daily()
        // ->emailOutputOnFailure('foo@example.com');
        
        /**
         * Task Hooks
         * Using the before and after methods, you may specify code to be executed before and after the 
         * scheduled task is complete:
         */
        // $schedule->command('emails:send')
        //  ->daily()
        //  ->before(function () {
        //      // Task is about to start...
        //  })
        //  ->after(function () {
        //      // Task is complete...
        //  });

        // The onSuccess and onFailure methods allow you to specify code to be executed if the scheduled 
        // task succeeds or fails:
        // $schedule->command('emails:send')
        //  ->daily()
        //  ->onSuccess(function () {
        //      // The task succeeded...
        //  })
        //  ->onFailure(function () {
        //      // The task failed...
        //  });

        // Pinging URLs
        // Using the pingBefore and thenPing methods, the scheduler can automatically ping a given URL before 
        // or after a task is complete. This method is useful for notifying an external service, 
        // such as Laravel Envoyer, that your scheduled task is commencing or has finished execution:
        // $schedule->command('emails:send')
        //  ->daily()
        //  ->pingBefore($url)
        //  ->thenPing($url);

        // The pingBeforeIf and thenPingIf methods may be used to ping a given URL only if the given condition is true:
        // $schedule->command('emails:send')
        // ->daily()
        // ->pingBeforeIf($condition, $url)
        // ->thenPingIf($condition, $url);

        // The pingOnSuccess and pingOnFailure methods may be used to ping a given URL only if the task succeeds or fails:
        // $schedule->command('emails:send')
        // ->daily()
        // ->pingOnSuccess($successUrl)
        // ->pingOnFailure($failureUrl);

        /**
         * All of the ping methods require the Guzzle HTTP library. 
         * You can add Guzzle to your project using the Composer package manager:
         */
        // composer require guzzlehttp/guzzle

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }

    /**
     * Remember that some timezones utilize daylight savings time. 
     * When daylight saving time changes occur, your scheduled task may run twice or even not run at all. 
     * For this reason, we recommend avoiding timezone scheduling when possible.
     */
    /**
     * Get the timezone that should be used by default for scheduled events.
     *
     * @return \DateTimeZone|string|null
     */
    protected function scheduleTimezone()
    {
        return 'Asia/Ho_Chi_Minh';
    }
}
