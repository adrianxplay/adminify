<?php
namespace Adrianxplay\Adminify\Admin;

use Adrianxplay\Adminify\Admin\Admin;
use Adrianxplay\Adminify\Role;

class RoleAdmin extends Admin{

  public $read_only = [
    'id', 'role', 'slug', 'description'
  ];

  public $properties = [
    'id' => [
      'field_type' => 'primary',
      'validation_rules' => 'required|unique'
    ],
    'role' => [
      'field_type' => 'string',
      'validation_rules' => 'required'
    ],
    'slug' => [
      'field_type' => 'string',
      'validation_rules' => 'required'
    ],
    'description' => [
      'field_type' => 'text',
    ]
  ];

  public $relationships = [];

  public $class_name = Role::class;

}
