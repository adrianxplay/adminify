<?php
namespace Adrianxplay\Adminify\Admin;

class Admin {

  /**
   * The list of properties that will be shown on the Admin list view
   * @var array
   */
  public $properties = [];

  /**
   * Pending
   * TODO: define property
   */
  public $relationships = [];

  /**
   * Set the Model class that will be administrated on the admin site
   *
   */
  function __construct(){
    $this->class_model = get_class_instance($this->class_name);
  }

  /**
   * Gets the current Model class
   *
   * @return object
   */
  public function get_model(){
    return $this->class_model;
  }

  /**
   * Gets the paginated data of the current model
   * @return Illuminate\Pagination\LengthAwarePaginator
   */
  public function paginate($offset){
    $model = $this->class_model;

    return $model->paginate($offset);
  }

}
