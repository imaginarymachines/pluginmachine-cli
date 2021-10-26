<?php

namespace App\Providers;

use App\Services\PluginMachineApi;
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
				config('services.plugin_machine.url','http://localhost'),
				config('services.plugin_machine.key','f9945846646f60fa3a4f554377d33020aa7b455df98a129865d9ac32c364d41c')
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
