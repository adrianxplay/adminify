<?php

namespace Adrianxplay\Adminify;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ["name", "slug", "enabled"];

    function elements(){
      return $this->hasMany('Adrianxplay\Adminify\MenuElement');
    }
}
