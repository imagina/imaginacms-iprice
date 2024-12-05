<?php

namespace Modules\Iprice\Entities;

use Astrotomic\Translatable\Translatable;
use Modules\Core\Icrud\Entities\CrudModel;

class Zone extends CrudModel
{
  use Translatable;

  protected $table = 'iprice__zones';
  public $transformer = 'Modules\Iprice\Transformers\ZoneTransformer';
  public $repository = 'Modules\Iprice\Repositories\ZoneRepository';
  public $requestValidation = [
      'create' => 'Modules\Iprice\Http\Requests\CreateZoneRequest',
      'update' => 'Modules\Iprice\Http\Requests\UpdateZoneRequest',
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
  public $translatedAttributes = ['title','description'];
  protected $fillable = ['system_name', 'status'];
}
