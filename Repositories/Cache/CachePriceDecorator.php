<?php

namespace Modules\Iprice\Repositories\Cache;

use Modules\Iprice\Repositories\PriceRepository;
use Modules\Core\Icrud\Repositories\Cache\BaseCacheCrudDecorator;

class CachePriceDecorator extends BaseCacheCrudDecorator implements PriceRepository
{
    public function __construct(PriceRepository $price)
    {
        parent::__construct();
        $this->entityName = 'iprice.prices';
        $this->repository = $price;
    }
}
