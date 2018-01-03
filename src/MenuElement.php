<?php

namespace Adrianxplay\Adminify;

use Illuminate\Database\Eloquent\Model;

class MenuElement extends Model
{
    protected $table = "menu_elements";

    protected $fillable = ["text", "url", "icon", "menu_id"];

    public function menu()
    {
      $this->belongsTo('Adrianxplay\Adminify\Menu');
    }
}
