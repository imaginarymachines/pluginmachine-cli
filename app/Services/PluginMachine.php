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
	protected $apiUrl;
	public function __construct(PluginMachineApi $api){
		$this->api = $api;
	}

	public function featureCode( string $feature, array $data,int $buildId ){
		$files = $this->api->featureCode($feature,$data,$buildId);
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
