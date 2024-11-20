<?php

namespace Modules\Iprice\Entities;

use Astrotomic\Translatable\Translatable;
use Modules\Core\Icrud\Entities\CrudModel;

class Price extends CrudModel
{
  use Translatable;

  protected $table = 'iprice__prices';
  public $transformer = 'Modules\Iprice\Transformers\PriceTransformer';
  public $repository = 'Modules\Iprice\Repositories\PriceRepository';
  public $requestValidation = [
    'create' => 'Modules\Iprice\Http\Requests\CreatePriceRequest',
    'update' => 'Modules\Iprice\Http\Requests\UpdatePriceRequest',
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
  public $translatedAttributes = [];
  protected $fillable = [
    'price',
    'entity_type',
    'entity_id',
    'zone'
  ];
}
