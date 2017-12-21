<?php

namespace Adrianxplay\Adminify\Http\Controllers;

use Illuminate\Http\Request;
use Adrianxplay\Adminify\Admin\UserAdmin;
use Validator;

class DashboardController extends Controller
{
    /**
     *  Show the default dashboar view
     *
     *  @return view
     */
    function index(Request $request){
      return view("adminify::layouts.dashboard");
    }

    /**
     * Get the list view for a Admin Model
     *
     * @return view
     */
    function list_model(Request $request, $slug){
      $class_name = ucfirst($slug)."Admin";
      // TODO: add class not found exception validation
      $Model = class_lookup($class_name);

      // TODO: add offset validation
      $data = $Model->paginate(10);


      return view("adminify::layouts.list")
             ->with([
               'data' => $data,
               'properties' => $Model->read_only,
               'slug' => $slug
             ]);
    }

    /**
     * Get the edit view for a edit an Model object
     * @return view
     */

    function edit_model(Request $request, $slug, $id){
      $class_name = ucfirst($slug)."Admin";
      $ModelAdmin = class_lookup($class_name);
      $Model = $ModelAdmin->get_model();

      $result = $Model->findOrFail($id);

      return view("adminify::layouts.edit", [
        'data' => $result,
        'properties' => $ModelAdmin->properties,
        'slug' => $slug,
        'id' => $id
      ]);
    }

    /**
     * Update a model
     * @return view
     */
    function update_model(Request $request, $slug, $id){

      $class_name = ucfirst($slug)."Admin";
      $ModelAdmin = class_lookup($class_name);
      $Model = $ModelAdmin->get_model();
      $result = $Model->findOrFail($id);
      $data = $request->toArray();
      $validation_rules = [];

      foreach ($ModelAdmin->properties as $field_name => $rules) {
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

      Validator::make($request->all(), $validation_rules)->validate();

      $update = $request->all();

      if(array_key_exists("password", $update)){
        if(empty($update["password"]))
          $update["password"] = $result->password;
        else
          $update["password"] = bcrypt($update["password"]);
      }

      $result->update($update);

      $result->save();

      return redirect()->back()->with('success', 'Model updated!');

    }

    /**
     * Get the edit view for create a new Model object
     * @return view
     */

    function new_model(Request $request, $slug){
      $class_name = ucfirst($slug)."Admin";
      $ModelAdmin = class_lookup($class_name);
      $Model = $ModelAdmin->get_model();

      return view("adminify::layouts.create", [
        'data' => [],
        'properties' => $ModelAdmin->properties,
        'slug' => $slug
      ]);
    }

    /**
     * Create a model instance
     * @return view
     */
    function create_model(Request $request, $slug, $id){

      $class_name = ucfirst($slug)."Admin";
      $ModelAdmin = class_lookup($class_name);
      $Model = $ModelAdmin->get_model();
      $result = $Model->findOrFail($id);
      $data = $request->toArray();
      $validation_rules = [];

      foreach ($ModelAdmin->properties as $field_name => $rules) {
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

      Validator::make($request->all(), $validation_rules)->validate();

      $update = $request->all();

      if(array_key_exists("password", $update)){
        if(empty($update["password"]))
          $update["password"] = $result->password;
        else
          $update["password"] = bcrypt($update["password"]);
      }

      $result->update($update);

      $result->save();

      return redirect()->back()->with('success', 'Model updated!');

    }

}
