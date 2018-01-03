<?php
namespace Adrianxplay\Adminify\Admin;

use Adrianxplay\Adminify\Admin\Admin;
use Adrianxplay\Adminify\MenuElement;

class MenuElementAdmin extends Admin{

  public $read_only = [
    'id', 'text', 'url', 'icon'
  ];

  public $properties = [
    'id' => [
      'field_type' => 'primary',
      'validation_rules' => 'required|unique'
    ],
    'text' => [
      'field_type' => 'string',
      'validation_rules' => 'required'
    ],
    'url' => [
      'field_type' => 'string',
      'validation_rules' => 'required'
    ],
    'icon' => [
      'field_type' => 'string',
      'validation_rules' => 'required'
    ],
    'menu_id' => [
      'field_type' => 'integer',
      'validation_rules' => 'required'
    ]
  ];

  public $relationships = [];

  public $class_name = MenuElement::class;

}
