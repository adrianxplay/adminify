<?php

namespace Adrianxplay\Adminify\Commands;

use Illuminate\Console\Command;
// use Adrianxplay\Adminify\Permission;
// use Adrianxplay\Adminify\Role;
use Adrianxplay\Adminify\Database\Seeds\DatabaseSeeder;

class PublishRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adminify:roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publish default roles';

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
        $seeder = new DatabaseSeeder();
        $seeder->run();
    }
}
