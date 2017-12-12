<?php

namespace Adrianxplay\Adminify;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = [
      'role', 'description', 'slug'
    ];
}
