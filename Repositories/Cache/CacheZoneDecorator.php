<?php

namespace Modules\Iprice\Repositories\Cache;

use Modules\Iprice\Repositories\ZoneRepository;
use Modules\Core\Icrud\Repositories\Cache\BaseCacheCrudDecorator;

class CacheZoneDecorator extends BaseCacheCrudDecorator implements ZoneRepository
{
    public function __construct(ZoneRepository $zone)
    {
        parent::__construct();
        $this->entityName = 'iprice.zones';
        $this->repository = $zone;
    }
}
