<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TrialExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'trial:expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for expired trails';

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
     * @return int
     */
    public function handle()
    {
        trailExpired();
        $this->info('Trail Expired Command Run successfully!');
    }
}
