<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;

class PluginMachineApi {

	protected $apiToken;
	protected $apiUrl;
	public function __construct(string $apiToken, string $apiUrl){
		$this->apiToken = $apiToken;
		$this->apiUrl = $apiUrl;
	}

	public function requestUrl(string $enpoint ): string{
		return sprintf( '%s/%s', $this->apiUrl, $enpoint );
	}

	public function featureCode( string $feature, array $data,$buildId, $pluginId ){
		$r = $this->getClientWithToken()
			->post( $this->requestUrl(
				//This is wrong.
				sprintf('/code/%s',$feature)
		)	,$data);
		if($r->successful()){
			return (array)$r->json();
		}
		return false;
	}

	public function getBuildCode($pluginId, $buildId){
		///plugins
		$r = $this->getClientWithToken()
			->post( $this->requestUrl( "/plugins/{$pluginId}/builds/{$buildId}/code" ) );
		dd($r);
	}

	public function getFeatureCode($pluginId, $buildId, $featureId){
		///plugins
		$r = $this->getClientWithToken()
			->get(
				$this->requestUrl( "/plugins/{$pluginId}/builds/{$buildId}/features/{$featureId}/code" ));
		dd($r);
	}

	public function addFeature($pluginId, $buildId, array $data){
		///plugins
		$r = $this->getClientWithToken()
			->post( $this->requestUrl( "/plugins/{$pluginId}/builds/{$buildId}/features" ),$data );
		dd($r);
	}

	public function addPlugin(array $data){
		///plugins
		$r = $this->getClientWithToken()
			->post( $this->requestUrl( "/plugins/",$data );
		dd($r);
	}

	protected function getClientWithToken():PendingRequest{
		return Http::withToken($this->apiToken);
	}
}
