<?php

namespace Modules\Iprice\Entities;

use Modules\Core\Icrud\Entities\CrudStaticModel;

class Operation extends CrudStaticModel
{
  const ADD = 1;
  const SUBTRACT = 2;

  public function __construct()
  {
    $this->records = [
      self::ADD => ['title' => trans('iprice::tariffs.operations.add'), 'id' => self::ADD, 'icon' => 'fa-solid fa-plus'],
      self::SUBTRACT => ['title' => trans('iprice::tariffs.operations.subtract'), 'id' => self::SUBTRACT, 'icon' => 'fa-solid fa-minus'],
    ];
  }
}
