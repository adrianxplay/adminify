<?php

/**
 * Get the instance of a class on the default
 * laravel namespace.
 *
 * @return object
 */

function get_class_instance($class){
  return new $class();
}

/**
 * Search for an Admin class to show on the administration site
 * first looks in the the default laravel namespace
 * if it fails try searching on the package namespace
 *
 * @return object
 */
function class_lookup($class_name){
  $data = [__APPNAMESPACE__, "Admin", $class_name];
  $class = implode($data, "\\");
  if(class_exists($class))
    return new $class();
  else if(class_exists("Adrianxplay\\Adminify\\Admin\\".$class_name)){
    $class = "Adrianxplay\\Adminify\\Admin\\".$class_name;
    return new $class();
  }
  else{
    throw new Exception("Class not found");
  }
}
