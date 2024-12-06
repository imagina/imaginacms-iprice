<?php

namespace Modules\Iprice\Entities;

use Modules\Core\Icrud\Entities\CrudStaticModel;

class Type extends CrudStaticModel
{
  const PERCENTAGE = 1;
  const FIXEDVALUE = 2;
  const REPLACE = 3;


  public function __construct()
  {
    $this->records = [
      self::PERCENTAGE => ['title' => trans('iprice::tariffs.types.percentage'), 'id' => self::PERCENTAGE, 'icon' => 'fa-solid fa-percent'],
      self::FIXEDVALUE => ['title' => trans('iprice::tariffs.types.fixedvalue'), 'id' => self::FIXEDVALUE, 'icon' => 'fa-solid fa-value-absolute'],
      self::REPLACE => ['title' => trans('iprice::tariffs.types.replace'), 'id' => self::REPLACE, 'icon' => 'fa-solid fa-swap-arrows'],
    ];
  }
}
