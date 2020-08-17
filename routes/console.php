<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('fetch', function (){
    $process = new \Symfony\Component\Process\Process(['bash', 'deploy.sh'], base_path());
    $process->run();
    if (!$process->isSuccessful()) {
        throw new \Symfony\Component\Process\Exception\ProcessFailedException($process);
    }
    $this->comment($process->getOutput());
})->describe('Fetch data from repository');

Artisan::command('commit', function (){
    $this->comment(exec('bash commit.sh'));
})->describe('Commit data to repository');
