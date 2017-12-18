<?php

function get_class_instance($class_name){
  $class = __APPNAMESPACE__."\\".$class_name;
  return new $class();
}


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
