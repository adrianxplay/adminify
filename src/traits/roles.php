<?php

namespace Adrianxplay\Adminify\Traits;

/**
 *
 */
trait Roles
{
  function role()
  {
    return $this->belongsTo('Adrianxplay\Adminify\Role');
  }

  function permissions(){
    return $this->belongsToMany('Adrianxplay\Adminify\Permission');
  }
}
