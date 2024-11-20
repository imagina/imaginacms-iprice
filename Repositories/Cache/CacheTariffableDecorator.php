<?php

namespace Modules\Iprice\Repositories\Cache;

use Modules\Iprice\Repositories\TariffableRepository;
use Modules\Core\Icrud\Repositories\Cache\BaseCacheCrudDecorator;

class CacheTariffableDecorator extends BaseCacheCrudDecorator implements TariffableRepository
{
    public function __construct(TariffableRepository $tariffable)
    {
        parent::__construct();
        $this->entityName = 'iprice.tariffables';
        $this->repository = $tariffable;
    }
}
