<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class ListSiteAdmins extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:list_admins';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get a tabulated list of all site administrators';

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
        $headers = [
            'Email Address',
            'Full Name', 
            'Account Key', 
            'Phone',
            'Address', 
            'Role', 
            'Sex'
        ];
        $users = User::all([
            'email', 
            'full_name',
            'user_key', 
            'telephone',
            'address', 
            'role', 
            'sex'
        ])->whereIn('role', ['admin', 'owner'])->toArray();

        $this->table($headers, $users);
    }
}
