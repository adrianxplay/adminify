<?php

namespace Adrianxplay\Adminify\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index(Request $request){
      return view("adminify::layouts.dashboard");
    }

    function list_model(Request $request, $slug){
      dd($slug);
    }

    function list_user(Request $request){
      
    }
}
