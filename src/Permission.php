<?php

namespace Adrianxplay\Adminify;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
  protected $fillable = [
    'permission', 'description'
  ];

  public function roles()
  {
    return $this->belongsToMany('Adrianxplay\Adminify\Role');
  }
}
