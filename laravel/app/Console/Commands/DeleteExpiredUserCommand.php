<?php

namespace App\Console\Commands;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class DeleteExpiredUserCommand extends Command
{
    const EXPIRED_IN_DAYS = '7';
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:delete_expired_users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to delete expired users and relations. User expires in 7days';

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
        User::where('created_at', '<=', Carbon::now()->subDays(self::EXPIRED_IN_DAYS))
        ->each(function(User $user) {
            $user->delete();
        });
    }
}
