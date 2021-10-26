<?php

namespace App\Services;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
class PluginMachinePlugin {

	public $writeDir;
	public $pluginId;
	public $currentBuildId;
	protected $api;

	public function __construct( int $pluginId, int $currentBuildId, string $writeDir) {
		$this->pluginId = $pluginId;
		$this->currentBuildId = $currentBuildId;
		$this->writeDir = $writeDir;
	}



}
