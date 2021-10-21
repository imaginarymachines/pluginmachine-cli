<?php

namespace App\Commands;

use App\Services\Features;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

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
    public function handle(Features $features)
    {
        $featureLabel = $this->choice(
			'What do you want to add to this plugin?',
			$features->getFeatureOptions('flat.label'),
			3
		);
		$feature = $features->getFeatureBy($featureLabel,'label');
		
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
