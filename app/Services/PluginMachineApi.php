<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
/**
 * API client for Plugin Machine
 */
class PluginMachineApi {

    /**
     * The API token
     *
     * @var string
     */
	protected $apiToken;

    /**
     * The API URL
     *
     * @var string
     */
	protected $apiUrl;
	public function __construct(string $apiUrl,string $apiToken){
		$this->apiToken = $apiToken;
		$this->apiUrl = $apiUrl;
	}

    /**
     * Create a full URL for API requests.
     */
	public function requestUrl(string $enpoint): string{
		return sprintf( '%s/api/v1/%s', $this->apiUrl, $enpoint );
	}

    /**
     * Get all plugins we could use.
     */
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

    /**
     * Get the code for a feature, by file path
     *
     * @param int $featureId
     * @param PluginMachinePlugin $plugin
     * @param string $file
     */
	public function getFeatureCode($featureId,PluginMachinePlugin $plugin , $file){
		$url = $this->requestUrl(
			"plugins/{$plugin->pluginId}/builds/{$plugin->buildId}/features/{$featureId}/code?file=" . urlencode($file)
		);
		///plugins
		$r = $this->getClientWithToken()
			->get( $url );
		return $r->body();
	}

     /**
     * Add a feature
     *
     * @param string $featureType
     * @param PluginMachinePlugin $plugin
     * @param array $data
     */
	public function addFeature(string $featureType, PluginMachinePlugin $plugin, array $data){
		$data['featureType'] = $featureType;
		$url = $this->requestUrl( "plugins/{$plugin->pluginId}/builds/{$plugin->buildId}/features" );
		///plugins
		$r = $this->getClientWithToken()
			->post( $url,$data );
		if(201 === $r->status() ){
			return [
				'files' => $r->json('files'),
				'id' => $r->json('setting.id'),
			];
		}else{
			throw new \Exception( $r->json('message') );
		}

	}

    //@TODO
	public function addPlugin(array $data){
		///plugins
		$r = $this->getClientWithToken()
			->post( $this->requestUrl( "/plugins/"),$data );
		dd($r);
	}

	 /**
     * Get the API client
     */
	protected function getClientWithToken():PendingRequest{
		return Http::withToken($this->apiToken);
	}
}
