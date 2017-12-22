<?php

namespace Adrianxplay\Adminify;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
      'role', 'description', 'slug'
    ];

    public function permissions()
    {
      return $this->belongsToMany('Adrianxplay\Adminify\Permission');
    }
}
