<?php

namespace App\Providers;

use App\Services\PluginMachine;
use App\Services\PluginMachineApi;
use App\Services\PluginMachinePlugin;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind( PluginMachineApi::class, function(){
			return new PluginMachineApi(
				config('plugin_machine.api.url'),
				config('plugin_machine.api.key')
			);

		});
		$this->app->singleton(PluginMachinePlugin::class, function (){
            $data = file_get_contents(dirname(__DIR__,1) . '/pluginMachine.json');
            $data = json_decode($data,fakse);
			return new PluginMachinePlugin(
				$data->pluginId,
				$data->buildId,
				config('plugin_machine.plugin.writeDir'),
                $data->buildIncludes,
                $data->slug,

			);

		});
		$this->app->singleton(PluginMachine::class, function(){
			return new PluginMachine(
				app( PluginMachineApi::class),
				app( PluginMachinePlugin::class)
			);
		});
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
