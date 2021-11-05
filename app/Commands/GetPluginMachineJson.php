<?php

namespace App\Commands;

use App\Services\PluginMachineApi;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class GetPluginMachineJson extends Command
{

    protected $signature = 'plugin:config {pluginId}';
    protected $description = 'Get pluginMachine.json for a plugin';


    public function handle(PluginMachineApi $api)
    {
        $pluginId = $this->argument('pluginId');
    }


}
