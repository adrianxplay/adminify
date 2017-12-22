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
        echo "creating root role";
        echo "\n";
        try{
          Role::create([
            'role' => 'Root',
            'slug' => 'root',
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

class PermissionSeeder extends Seeder{
  public function run(){

    $editor_role = Role::whereSlug('editor')->first();

    $p = Permission::create([
      'permission' => 'create.user',
      'description' => 'create users'
    ]);

    $editor_role->permissions()->save($p);

    $p = Permission::create([
      'permission' => 'read.user',
      'description' => 'read users'
    ]);

    $editor_role->permissions()->save($p);

    $p = Permission::create([
      'permission' => 'update.user',
      'description' => 'update users'
    ]);

    $editor_role->permissions()->save($p);

    $p = Permission::create([
      'permission' => 'delete.user',
      'description' => 'delete users'
    ]);

    $editor_role->permissions()->save($p);
  }
}
