<?php

namespace App\Commands;

use App\Services\PluginMachinePlugin;
use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

class Zip extends Command
{

    protected $signature = 'plugin:zip';

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
    public function handle(PluginMachinePlugin $pluginMachinePlugin)
    {

        $zip = new \ZipArchive();
        $path = storage_path(sprintf('%s.zip', $pluginMachinePlugin->slug);
        $zip->open(storage_path(sprintf('%s.zip', $pluginMachinePlugin->slug)), \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        foreach ($pluginMachinePlugin->includes as $file) {
            if( is_dir($file) ) {
                foreach (scandir($file) as $_file) {
                    $zip->addFile($_file);
                }
            }else{
                $zip->addFile($file);
            }
        }
        $zip->close();
        $this->info(sprintf('created zip: ', $path));

    }

    public function saveZipArchive(PluginMachinePlugin $pluginMachinePlugin)
    {
        $zip = new \ZipArchive();
        $zip->open(storage_path(sprintf('test/builds/%s', $this->zipFileName)), \ZipArchive::CREATE | \ZipArchive::OVERWRITE);
        foreach ($pluginMachinePlugin->includes as $file) {
            $zip->addFromString($fileName, $contents);
        }
        $zip->close();
    }
}
