<?php

namespace Modules\Iprice\Entities;

use Astrotomic\Translatable\Translatable;
use Modules\Core\Icrud\Entities\CrudModel;

class Tariff extends CrudModel
{
  use Translatable;

  protected $table = 'iprice__tariffs';
  public $transformer = 'Modules\Iprice\Transformers\TariffTransformer';
  public $repository = 'Modules\Iprice\Repositories\TariffRepository';
  public $requestValidation = [
    'create' => 'Modules\Iprice\Http\Requests\CreateTariffRequest',
    'update' => 'Modules\Iprice\Http\Requests\UpdateTariffRequest',
  ];
  //Instance external/internal events to dispatch with extraData
  public $dispatchesEventsWithBindings = [
    //eg. ['path' => 'path/module/event', 'extraData' => [/*...optional*/]]
    'created' => [],
    'creating' => [],
    'updated' => [],
    'updating' => [],
    'deleting' => [],
    'deleted' => []
  ];
  public $translatedAttributes = [
    'title'
  ];
  protected $fillable = [
    'status',
    'type',
    'operation',
    'value',
    'departments',
    'start_date',
    'end_date',
    'priority'
  ];
}
