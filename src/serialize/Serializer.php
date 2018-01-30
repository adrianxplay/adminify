<?php

namespace Adrianxplay\Adminify\Serialize;

use Adrianxplay\Adminify\Admin\Admin;

class Serializer {

  private $paginationLenght;

  function __construct(Admin $model, $data = null){
    $this->paginationLenght = config("adminify.model_pagination_lenght");

    foreach ($model->properties as $prop => $value) {
      if( ! is_null($data))
        $this->{$prop} = $data->{$prop};
      else
        $this->{$prop} = '';
    }

    $this->meta = [
      'name' => (new \ReflectionClass($model->class_name))->getShortName(),
      'class' => $model->class_name,
      'paginationLenght' => $this->paginationLenght,
      'relationships' => [],
    ];

    foreach ($model->relationships as $type => $collections) {
      $data = [];

      foreach ($collections as $key => $value) {
        $collectionClassName = ((new \ReflectionClass($value))->getShortName()."Admin");
        $collectionClassObject = class_lookup($collectionClassName);
        foreach ($collectionClassObject->class_model->paginate($this->paginationLenght) as $element) {
          $data[] = new Serializer($collectionClassObject, $element);
        }
      }

      $this->meta['relationships'][$type][] = [
        'name' => $data[0]->meta['name'],
        'class' => $data[0]->meta['class'],
        'collection' => $data,
        'subscribed' => [],
        'to_subscribe' => [],
        'to_unsubscribe' => []
      ];
    }

  }

  function __toString(){
    return json_encode($this);
  }
}
