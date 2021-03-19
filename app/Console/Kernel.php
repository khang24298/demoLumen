<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\DB;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            $results = DB::select('select *
            from a where not exists(
                select email from b where a.email = b.email)
            ');
            // dd($results);
            foreach($results as $item){
                // echo $item->name;
                DB::table('b')->insert([
                    [
                        'name' => $item->name,
                        'email' => $item->email,
                        'password' => $item->password
                    ]
                ]);
            }
        })->everyThreeMinutes();
    }
}
