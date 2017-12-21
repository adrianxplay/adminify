<?php

Route::middleware('web')->prefix('admin')->group(function(){

  $namespace = 'Adrianxplay\Adminify\Http\Controllers\\';

  Route::get('dashboard', $namespace.'DashboardController@index');
  Route::get('dashboard/{slug}', $namespace.'DashboardController@list_model');

  Route::get(
    'dashboard/{slug}/create',
    $namespace.'DashboardController@new_model'
  )->name('adminify.new-model');

  Route::post(
    'dashboard/{slug}',
    $namespace.'DashboardController@create_model'
  )->name('adminify.create-model');

  Route::get(
    'dashboard/{slug}/{id}',
    $namespace.'DashboardController@edit_model'
  )->name('adminify.edit-model');

  Route::post(
    'dashboard/{slug}/{id}',
    $namespace.'DashboardController@update_model'
  )->name('adminify.update-model');

});
