<?php
namespace Adrianxplay\Adminify\Admin;

use Adrianxplay\Adminify\Admin\Admin;
use Adrianxplay\Adminify\Menu;

class MenuAdmin extends Admin{

  public $read_only = [
    'id', 'name', 'slug', 'enabled'
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
    'slug' => [
      'field_type' => 'string',
      'validation_rules' => 'required'
    ],
    'enabled' => [
      'field_type' => 'integer',
      'validation_rules' => 'required'
    ]
  ];

  public $relationships = [];

  public $class_name = Menu::class;

}
