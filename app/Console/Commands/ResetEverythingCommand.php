<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class ResetEverythingCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'devto:reset';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reset everything!';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $test = Artisan::call('migrate:refresh', [
            '--seed' => TRUE
        ]);
    }
}
