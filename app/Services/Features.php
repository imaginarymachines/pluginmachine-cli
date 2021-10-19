<?php

namespace App\Services;

use Illuminate\Support\ServiceProvider;

class Features {

	protected  $features;
	protected $data;
	public function __construct(){
		$this->data = (array) json_decode(file_get_contents(__DIR__.'/data/features.json'));
		$this->features = collect($this->data)->map(function($feature){
			return $feature->feature;
		})->toArray();
	}
	public function getFeatureOptions($as = 'flat',bool $withPluginHooks = false) :array {
		$options = [];
		switch ($as) {
			case 'flat.value':
			case 'flat':
				foreach ($this->getFeatures($withPluginHooks) as $key => $value) {
					$options[] = $value->type;
				}
				break;
			case 'flat.label':
			case 'flat.label.singular':

				foreach ($this->getFeatures($withPluginHooks) as $key => $value) {

					$options[] = $value->singular;
				}
				break;
			default:
				$options = $this->getFeatures($withPluginHooks);
				break;
		}
		return $options;
	}


	public function getFeatures( bool $withPluginHooks = false ): array{
		if( ! $withPluginHooks){
			return collect( $this->features )->filter(function($feature){
				return false == $feature->isPluginHook;
			})->toArray();
		}
	}
}
