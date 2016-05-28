<?php

namespace IdeaSeven\Core\Console\Commands;

use Hash;
use IdeaSeven\Core\Models\User;
use Illuminate\Console\Command;
use Bican\Roles\Models\Role;
use Cocur\Slugify\Slugify;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'core:createUser {email} {password}
    {--firstName=} {--lastName=} {--role=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new user';

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
        $slug = ($this->option('role')) ?: 'moderator';
        $role = Role::where('slug',$slug)->first();

        $user = User::create([
            'firstName' => ($this->option('firstName')) ?: '',
            'lastName' => ($this->option('lastName')) ?: '',
            'email' => $this->argument('email'),
            'password' => Hash::make($this->argument('password'))
        ])->attachRole($role);


    }
}
