<?php

/**
 * Get the instance of a class on the default
 * laravel namespace.
 *
 * @return object
 */

function get_class_instance($class_name){
  $class = __APPNAMESPACE__."\\".$class_name;
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
  $class = __APPNAMESPACE__."\\Admin\\".$class_name;
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

/**
 * Get the form elements that are model values
 * @return array
 */
function get_form_fields(Array $array){

  $filtered = array_filter($array, function($array){
    if(strpos($array, '-field') !== false)
      return $array;
  }, ARRAY_FILTER_USE_KEY);

  $results = [];

  foreach($filtered as $key => $value){
    $new_key = str_replace("-field", "", $key);
    $results[$new_key] = $value;
  }

  return $results;

}
