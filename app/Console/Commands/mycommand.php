<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Log;

class mycommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'raghad';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'my command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $x = $this->ask("how are you");
        echo $x;
    }
}
