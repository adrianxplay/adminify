<?php

namespace Adrianxplay\Adminify\Traits;

/**
 *
 */
trait ModelValidator
{

  function getValidationRules(Array $properties){
    $validation_rules = [];

    foreach ($properties as $field_name => $rules) {
      $model_array = $rules;
      $form_type = $model_array['field_type'];
      $model_data = sizeof($model_array) > 1 ? $model_array['validation_rules'] : "";
      $validation_str = "";

      if($form_type === "primary")
        continue;

      if($field_name === "email")
        $validation_str .= "$field_name|";
      else if($field_name === "password")
        $validation_str .= "confirmed|";

      if(! empty($model_data))
        $validation_str .= $model_data;

      $validation_rules[$field_name] = $validation_str;

    }
    return $validation_rules;
  }

}
