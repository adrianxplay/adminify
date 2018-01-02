<?php

Route::middleware(['web', 'auth'])->prefix('admin')->group(function(){

  $namespace = 'Adrianxplay\Adminify\Http\Controllers\\';

  Route::get('/', function(){
    return redirect('admin/dashboard');
  });

  Route::get('dashboard', $namespace.'DashboardController@index');
  Route::get('/{slug}', $namespace.'DashboardController@list_model');

  Route::get(
    '{slug}/create',
    $namespace.'DashboardController@new_model'
  )->name('adminify.new-model');

  Route::post(
    '{slug}',
    $namespace.'DashboardController@create_model'
  )->name('adminify.create-model');

  Route::get(
    '{slug}/{id}',
    $namespace.'DashboardController@edit_model'
  )->name('adminify.edit-model');

  Route::post(
    '{slug}/{id}',
    $namespace.'DashboardController@update_model'
  )->name('adminify.update-model');

});
