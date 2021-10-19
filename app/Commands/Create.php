<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Create extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'create';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
		$opts = ['y', 'n'];
		$haveFiles = $this->choice(
			'Do you already have files for this plugin?',
			$opts,
			1
		);
		$needReact = $this->choice(
			'Do you want to use React?',
			$opts,
			1
		);

		$needComposer = $this->choice(
			'Do you want to use Composer for dependecies, or running tests?',
			$opts,
			1
		);

		//php or js options?
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
