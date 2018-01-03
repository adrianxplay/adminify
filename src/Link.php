<?php

namespace Adrianxplay\Adminify;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $fillable = ["text", "url", "icon", "menu_id"];

    public function menu()
    {
      $this->belongsTo('Adrianxplay\Adminify\Menu');
    }
}
