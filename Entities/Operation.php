<?php

namespace Modules\Iprice\Entities;

class Operation
{
  const ADD = 1;
  const SUBTRACT = 2;

  private $types;

  public function __construct()
  {
    $this->types = [
      self::ADD => ['title' => trans('iprice::tariffs.operations.add'), 'id' => self::ADD, 'icon' => 'fa-solid fa-plus'],
      self::SUBTRACT => ['title' => trans('iprice::tariffs.operations.subtract'), 'id' => self::SUBTRACT, 'icon' => 'fa-solid fa-minus'],
    ];
  }
}
