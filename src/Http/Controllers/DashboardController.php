<?php

namespace Adrianxplay\Adminify\Http\Controllers;

use Illuminate\Http\Request;
use Adrianxplay\Adminify\Admin\UserAdmin;

class DashboardController extends Controller
{
    function index(Request $request){
      return view("adminify::layouts.dashboard");
    }

    function list_model(Request $request, $slug){
      $class_name = ucfirst($slug)."Admin";
      $Model = class_lookup($class_name);

      $data = $Model->paginate(10);

      return view("adminify::layouts.list")
             ->with([
               'data' => $data,
               'properties' => $Model->properties
             ]);
    }

    function list_user(Request $request){
      $admin = new UserAdmin();
      $users = $admin->paginate(10);

      return view("adminify::layouts.list")
             ->with([
               'data' => $users,
               'properties' => $admin->properties
             ]);
    }
}
