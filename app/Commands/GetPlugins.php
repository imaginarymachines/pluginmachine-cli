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

    protected $signature = 'plugins:all';
    protected $description = 'List all plugins';
    public function handle(Features $features,PluginMachineApi $api)
    {

		$plugins = $api->getPlugins();
        $this->table(array_keys($plugins[0]), $plugins);

    }
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
