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

	public function featureCode( string $feature, array $data,$buildId = '' ){
		$r = $this->getClientWithToken()
			->post( $this->requestUrl(
				sprintf('/code/%s',$feature)
		)	,$data);
		if($r->successful()){
			return (array)$r->json();
		}
		return false
	}

	protected function getClientWithToken():PendingRequest{
		return Http::withToken($this->apiToken);
	}
}
