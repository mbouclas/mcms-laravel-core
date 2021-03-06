<?php

namespace IdeaSeven\Core\Console\Commands;

use Illuminate\Console\Command;
use Bican\Roles\Models\Permission;
use Cocur\Slugify\Slugify;

class CreateUserPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'core:createPermission {name} 
    {--slug=} {--description=} {--model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creates a new Permission';

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
        //
        $slugify = new Slugify();
        Permission::create([
            'name' => $this->argument('name'),
            'slug' => ($this->option('slug')) ?: $slugify->slugify($this->argument('name'),'.'),
            'description' => $this->option('description'),
            'model' => $this->option('model'),
        ]);


    }
}
