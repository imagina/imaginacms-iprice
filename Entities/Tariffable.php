<?php

namespace Modules\Iprice\Entities;

use Astrotomic\Translatable\Translatable;
use Modules\Core\Icrud\Entities\CrudModel;

class Tariffable extends CrudModel
{
  use Translatable;

  protected $table = 'iprice__listables';
  public $transformer = 'Modules\Iprice\Transformers\ListableTransformer';
  public $repository = 'Modules\Iprice\Repositories\ListableRepository';
  public $requestValidation = [
    'create' => 'Modules\Iprice\Http\Requests\CreateListableRequest',
    'update' => 'Modules\Iprice\Http\Requests\UpdateListableRequest',
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
    'entity_type',
    'entity_id',
    'list_id',
    'value',
    'price_id'
  ];
}
