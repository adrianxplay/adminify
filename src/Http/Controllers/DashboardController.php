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

      dd($data);

      return view("adminify::layouts.list")
             ->with([
               'data' => $data,
               'properties' => $Model->properties
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

      dd($Model->findOrFail($id));
    }

}
