<?php

namespace Adrianxplay\Adminify\Database\Seeds;

use Illuminate\Database\Seeder;
use Adrianxplay\Adminify\Role;
use Adrianxplay\Adminify\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        echo "creating admin role";
        echo "\n";
        try{
          Role::create([
            'role' => 'Administrator',
            'slug' => 'admin',
            'description' => 'Root user',
          ]);
        }catch(Exception $e){
          throw $e;
        }
        finally{
          echo "success";
          echo "\n";
        }

    }
}
