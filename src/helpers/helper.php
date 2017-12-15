<?php

function get_class_instance($class_name){
  $class = __APPNAMESPACE__."\\".$class_name;
  return new $class();
}
