<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
class PluginMachinePlugin {

	public $slug;
	public $pluginId;
	public $currentBuildId;
	protected $api;

	public function __construct( \stdClass $configData,PluginMachine $api ){
		$this->slug = $configData->slug;
		$this->pluginId = $configData->pluginId;
		$this->currentBuildId = $configData->currentBuildId;
		$this->api = $api;

	}

	public function newVersion(){

	}

	public function newFeature(string $feature, array $args){
		$this->api->featureCode($feature, $args, $this->currentBuildId);
	}


}
