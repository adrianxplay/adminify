<?php
namespace Adrianxplay\Adminify\Admin;

use Adrianxplay\Adminify\Admin\Admin;
use App\User;

class UserAdmin extends Admin{

  public $read_only = [
    'id', 'name', 'email', 'role_id'
  ];

  public $properties = [
    'id' => [
      'field_type' => 'primary',
      'validation_rules' => 'required|unique'
    ],
    'name' => [
      'field_type' => 'string',
      'validation_rules' => 'required'
    ],
    'email' => [
      'field_type' => 'email'
    ],
    'password' => [
      'field_type' => 'password'
    ]
  ];

  public $relationships = [];

  public $class_name = User::class;

}
