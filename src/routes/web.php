<?php

Route::prefix('admin')->group(function(){

  Route::get('dashboard', function(){
    dd('test');
  });

});
