<?php

namespace Modules\Iprice\Repositories\Cache;

use Modules\Iprice\Repositories\TariffRepository;
use Modules\Core\Icrud\Repositories\Cache\BaseCacheCrudDecorator;

class CacheTariffDecorator extends BaseCacheCrudDecorator implements TariffRepository
{
    public function __construct(TariffRepository $tariff)
    {
        parent::__construct();
        $this->entityName = 'iprice.tariffs';
        $this->repository = $tariff;
    }
}
