<?php

namespace App\Commands;

use App\Services\Features;
use App\Services\PluginMachine;
use App\Services\PluginMachineApi;
use App\Services\PluginMachinePlugin;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Add extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'add';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Add feature to plugin';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(Features $features, PluginMachine  $machine)
    {


        $featureLabel = $this->choice(
			'What do you want to add to this plugin?',
			$features->getFeatureOptions('flat.label'),
			3
		);
		//$featureLabel = "Admin Menu Page";
		$feature = $features->getFeatureBy($featureLabel,'singular');
		$rules = $features->getRules($feature->type);
		$data = [];
		foreach ($rules as $key => $field) {
			$label = isset($field->label)&&! empty($field->label) ? $field->label : $key;

			if( isset($field->options) ){
				$options = (array)$field->options;
				$value = $this->choice(
					$label,
					array_values($options),
					Arr::first($options)
				);
                switch($feature->type){
                    case 'adminPage':
                        $data[$key] = strtoupper($value);
                    break;
                    default:
                        $data[$key] = strtolower($value);
                    break;
                }
			}else{
				$data[$key] = $this->ask($label);
			}

		}

        try {
            $r = $machine->addFeature($feature->type,$data);
            foreach ($r as $file) {
                $this->info('Added file: ' . $file);
            }
        } catch (\Throwable $th) {
            $this->error($th->getMessage());
        }



    }


}
