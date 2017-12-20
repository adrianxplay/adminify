<?php

namespace Adrianxplay\Adminify\Http\Controllers;

use Illuminate\Http\Request;
use Adrianxplay\Adminify\Admin\UserAdmin;

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
     * Get the edit view for a Admin Model object
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
      $data = get_form_fields($request->toArray());

      foreach ($data as $key => $value) {
        $result[$key] = $value;
      }

      $result->save();

    }

}
