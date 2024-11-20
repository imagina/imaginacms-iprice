<?php

namespace Modules\Iprice\Entities;

use Illuminate\Database\Eloquent\Model;

class TariffTranslation extends Model
{
  public $timestamps = false;
  protected $fillable = [
    'title'
  ];
  protected $table = 'iprice__tariff_translations';
}
