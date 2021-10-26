<?php
use Illuminate\Support\Facades\Storage;

$data = Storage::get( 'pluginMachine.json');
$data = json_decode($data, false);
return [
	'api' => [
		'url' => env('PLUGIN_MACHINE_URL', 'http://localhost'),
		'token' => env('PLUGIN_MACHINE_TOKEN', 'f9945846646f60fa3a4f554377d33020aa7b455df98a129865d9ac32c364d41c')
	],
	'plugin' => [
		'pluginId' => $data->pluginId,
		'buildId' => $data->buildId,
		'writeDir' => __DIR__

	]
];
