<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
class PluginMachine {

	/**
	 * @var PluginMachineApi
	 */
	protected $api;
	protected $plugin;
	public function __construct(PluginMachineApi $api, PluginMachinePlugin $plugin){
		$this->api = $api;
		$this->plugin = $plugin;
	}

	public function addFeature( string $feature, array $data ){
		$featureId = $this->api->addFeature( $feature,$this->plugin->buildId, $data );
		$files = $this->api->getFeatureCode(
			$this->plugin->buildId,
			$this->plugin->buildId,
			$featureId
		);
		if( ! $files ){
			//?
			return false;
		}
		foreach ($files as $path => $contents) {
			Storage::put($path, $contents);
		}
		return true;
	}

	protected function getClientWithToken():PendingRequest{
		return Http::withToken($this->apiToken);
	}
}
