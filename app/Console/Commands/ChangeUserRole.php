<?php

namespace App\Console\Commands;

use App\Notifications\UserRoleChanged;
use App\User;
use Illuminate\Console\Command;

class ChangeUserRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:change_role';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Change the role of a user.';


    /**
     * 
     */
    protected $userKey; 
    protected $userID; 
    protected $user;
    protected $roles = [
        'uuser' => 'user', 
        'uadmin' => 'admin', 
        'uowner' => 'owner'
    ];

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
        $userKeyMail = $this->ask("Enter user's key or email address?"); 
        $this->line("Searching for user..."); 
        $user = User::where('user_key', $userKeyMail)->orWhere('email', $userKeyMail)->first(); 
        if (!$user){
            return $this->error("User with the given key not found!");
        }
        
        $this->user = $user;
        $this->userKey = $user->user_key;
        $this->userID = $user->id;
        $this->line("");
        $this->line("");
        $this->line("");
        $this->line("");
        $this->info("User found:"); 
        $this->line("User Name:     ".$user->full_name);
        $this->line("User Email:    ".$user->email);
        $this->line("Current Role:  ".$user->role);
        // dd($user);
        $role = $this->ask("Select a urole for this user.");
        if (!in_array($role, array_keys($this->roles))){
            return $this->error("Process Terminated"); 
        }

        $user->role = $this->roles[$role]; 
        $user->save(); 
        $user->notify(new UserRoleChanged($user));

        return $this->info("User role has been changed.");
    }
}
