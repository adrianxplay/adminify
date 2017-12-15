<?php

Route::prefix('admin')->group(function(){

  $namespace = 'Adrianxplay\Adminify\Http\Controllers\\';

  Route::get('dashboard', $namespace.'DashboardController@index');

  Route::get('dashboard/{slug}', $namespace.'DashboardController@list_model');

});
