<?php
namespace App\Traits;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;



trait RunsProcess {


    /**
     * Run a command in a seperate process.
     */
    public function runProcess(array $command)
    {
        $process = new Process($command);
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        return $process->getOutput();
    }
}
