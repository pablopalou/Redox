<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            $apiKey = env('API_KEY');
            $apiSecret = env('API_SECRET');
            $response = Http::asForm()->post('https://api.redoxengine.com/auth/authenticate',
            [
                'apiKey' => $apiKey,
                'secret' => $apiSecret,
                'grant_type' => 'client_credentials'
            ]
            );
            // dd($response);
            // dd($response->json()['accessToken']);
            $token = $response->json()['accessToken'];
            // dd($token);
            cache(['token' => $token], now()->addDay());
            
            // Config::set('app.token', $token);
            // dd(Config::get('app.token'));
            // $_ENV['TOKEN'] = $token;
            // dd(env('TOKEN'));
            // dd(getenv());
        })->everyMinute();

        // $schedule->exec('php artisan cache:clear');
        // $schedule->exec('php artisan config:clear');
        // $schedule->exec('php artisan route:clear');

        // ->twiceDaily(1, 13);
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
