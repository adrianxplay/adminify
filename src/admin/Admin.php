<?php
namespace Adrianxplay\Adminify\Admin;

class Admin {

  public $properties = [];

  public $relationships = [];

  function __construct(){
    $this->class_model = get_class_instance($this->class_name);
  }

  public function get_model(){
    return $this->class_model;
  }


  public function paginate($offset){
    $model = $this->class_model;

    return $model->paginate($offset);
  }

}
