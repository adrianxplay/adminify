<?php
namespace Adrianxplay\Adminify\Admin;

use Adrianxplay\Adminify\Admin\Admin;

class UserAdmin extends Admin{

  public $properties = [
    'id', 'name', 'email', 'created_at'
  ];

  public $relationships = [];

  public $class_name = "User";

}
