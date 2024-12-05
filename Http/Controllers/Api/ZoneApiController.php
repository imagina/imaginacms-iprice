<?php

namespace Modules\Iprice\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model
use Modules\Iprice\Entities\Zone;
use Modules\Iprice\Repositories\ZoneRepository;

class ZoneApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(Zone $model, ZoneRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }
}
