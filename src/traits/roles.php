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

  function getAllPermissions(){
    $permissions = $this->permissions;
    return $permissions->merge($this->role->permissions);
  }

  function isAllowedTo(string $permission){
    $permissions = $this->getAllPermissions();
    return !is_null($permissions->firstWhere('permission', $permission));
  }
}
