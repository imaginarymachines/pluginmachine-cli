<?php

$data = file_get_contents(dirname(__DIR__,1) . '/pluginMachine.json');
$data = json_decode($data, false);
return [
	'api' => [
		'url' => env('PLUGIN_MACHINE_URL', 'http://localhost'),
		'key' => env('PLUGIN_MACHINE_TOKEN', 'f9945846646f60fa3a4f554377d33020aa7b455df98a129865d9ac32c364d41c')
	],
	'plugin' => [
		'pluginId' => (int)$data->pluginId,
		'buildId' => (int)$data->buildId,
		'writeDir' =>'testwrite',

	]
];
