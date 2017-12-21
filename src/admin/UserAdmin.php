<?php
namespace Adrianxplay\Adminify\Admin;

use Adrianxplay\Adminify\Admin\Admin;
use App\User;

class UserAdmin extends Admin{

  public $read_only = [
    'id', 'name', 'email', 'role_id'
  ];

  public $properties = [
    'id' => "primary",
    // 'id' => [
    //   'field_type' => 'primary',
    //   'validation_rules' => 'required|unique'
    // ]
    'name' => "string,required",
    'email' => "email",
    'password' => 'password'
  ];

  public $relationships = [];

  public $class_name = User::class;

}
