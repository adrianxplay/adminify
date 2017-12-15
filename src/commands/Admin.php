<?php
namespace Adrianxplay\Adminify\Commands;

use Illuminate\Console\Command;
use Adrianxplay\Adminify\Role;
class Admin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'adminify:admin {email} {--create}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make a registered user an admin';

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
        $email = $this->argument("email");
        $User = get_class_instance("User");
        if($User->whereEmail($email)->exists() && $this->option("create")){
          $this->error("User already exists");
          $this->info("To give user admin permissions use adminify:admin without --create");
          return;
        }
        if($this->option("create")){
          $name = $this->ask("Admin name");
          $confirm = $this->confirm("Create user with default password [123456789]?");
          if(!$confirm){
            $p1 = $this->secret("Admin password");
            $p2 = $this->secret("Confirm admin password");
            while($p1 !== $p2){
              $this->info('the passwords does not match');
              $p1 = $this->secret("Admin password");
              $p2 = $this->secret("Confirm admin password");
            }
            $password = bcrypt($p1);
          }
          else{
            $password = bcrypt("123456789");
          }

          $admin_role = Role::whereSlug('admin')->first();

          try {
            $admin = $User->create([
              'name' => $name,
              'password' => $password,
              'email' => $email,
            ]);
            $admin->role_id  = $admin_role->id;

            $admin->save();
          } catch (\Exception $e) {
            throw $e;
          }
          finally {
            $this->info('Success!');
          }


          // $admin->

        }
        else{
          $admin_role = Role::whereSlug('admin')->first();
          $admin = $User->whereEmail($email)->first();
          $admin->role_id = $admin_role->id;
          $admin->save();

          $this->info('User has root access now');
        }

    }
}
