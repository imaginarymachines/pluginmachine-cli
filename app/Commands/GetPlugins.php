<?php

namespace App\Commands;

use App\Services\Features;
use App\Services\PluginMachineApi;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GetPlugins extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'plugins:all';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'List all plugins';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Features $features,PluginMachineApi $api)
    {

		$plugins = $api->getPlugins();
		dd($plugins);

    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
