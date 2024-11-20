<?php

namespace Modules\Iprice\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model
use Modules\Iprice\Entities\Tariff;
use Modules\Iprice\Repositories\TariffRepository;

class TariffApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(Tariff $model, TariffRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }
}
