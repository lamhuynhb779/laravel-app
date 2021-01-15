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
}
