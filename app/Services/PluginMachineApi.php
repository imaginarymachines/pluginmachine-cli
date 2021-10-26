<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
class PluginMachineApi {

	protected $apiToken;
	protected $apiUrl;
	public function __construct(string $apiUrl,string $apiToken ){
		$this->apiToken = $apiToken;
		$this->apiUrl = $apiUrl;
	}

	public function requestUrl(string $enpoint ): string{
		return sprintf( '%s/api/v1/%s', $this->apiUrl, $enpoint );
	}

	public function getPlugins(){
		$r = $this->getClientWithToken()
			->get(
				$this->requestUrl('plugins')
		);
		return collect($r->json()['data'])->map(function($plugin){
			return Arr::only(
				$plugin,
				['id','current_version']
			);
		});
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
			->post( $this->requestUrl( "plugins/{$pluginId}/builds/{$buildId}/code" ) );
		return $r->body();
	}

	public function getFeatureCode($pluginId, $buildId, $featureId){
		///plugins
		$r = $this->getClientWithToken()
			->get(
				$this->requestUrl( "plugins/{$pluginId}/builds/{$buildId}/features/{$featureId}/code" ));
		return $r->body();
	}

	public function addFeature($pluginId, $buildId, array $data){
		///plugins
		$r = $this->getClientWithToken()
			->post( $this->requestUrl( "plugins/{$pluginId}/builds/{$buildId}/features" ),$data );
		dd($r);
	}

	public function addPlugin(array $data){
		///plugins
		$r = $this->getClientWithToken()
			->post( $this->requestUrl( "/plugins/"),$data );
		dd($r);
	}

	protected function getClientWithToken():PendingRequest{
		return Http::withToken($this->apiToken);
	}
}
