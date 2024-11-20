<?php

namespace Modules\Iprice\Http\Controllers\Api;

use Modules\Core\Icrud\Controllers\BaseCrudController;
//Model
use Modules\Iprice\Entities\Price;
use Modules\Iprice\Repositories\PriceRepository;

class PriceApiController extends BaseCrudController
{
  public $model;
  public $modelRepository;

  public function __construct(Price $model, PriceRepository $modelRepository)
  {
    $this->model = $model;
    $this->modelRepository = $modelRepository;
  }
}
