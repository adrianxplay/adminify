<?php

Route::prefix('admin')->group(function(){

  Route::get('dashboard', function(){
    return view("adminify::layouts.dashboard");
  });

});
