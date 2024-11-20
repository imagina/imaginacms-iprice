<?php

namespace Modules\Iprice\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model
use Modules\Iprice\Entities\Tariffable;
use Modules\Iprice\Repositories\TariffableRepository;

class TariffableApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(Tariffable $model, TariffableRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }
}
