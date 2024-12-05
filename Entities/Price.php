<?php

namespace Modules\Iprice\Entities;

use Modules\Core\Icrud\Entities\CrudModel;

class Price extends CrudModel
{
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
    'zone_id'
  ];

  public function zone()
  {
    return $this->belongsTo(Zone::class, 'id', 'zone_id');
  }
}
