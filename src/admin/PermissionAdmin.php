<?php
namespace Adrianxplay\Adminify\Admin;

use Adrianxplay\Adminify\Admin\Admin;
use Adrianxplay\Adminify\Permission;

class PermissionAdmin extends Admin{

  public $read_only = [
    'id', 'permission', 'description'
  ];

  public $properties = [
    'id' => [
      'field_type' => 'primary',
      'validation_rules' => 'required|unique'
    ],
    'permission' => [
      'field_type' => 'string',
      'validation_rules' => 'required'
    ],
    'description' => [
      'field_type' => 'text',
    ]
  ];

  public $relationships = [];

  public $class_name = Permission::class;

}
