<?php

namespace Adrianxplay\Adminify;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = ["name", "slug", "enabled"];

    function links(){
      return $this->hasMany('Adrianxplay\Adminify\Link');
    }
}
