<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class UserEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check User Event';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return Command::SUCCESS;
    }
}
