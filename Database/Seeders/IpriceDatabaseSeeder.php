<?php

namespace Modules\Iprice\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Isite\Jobs\ProcessSeeds;
use Illuminate\Database\Eloquent\Model;

class IpriceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Model::unguard();
      ProcessSeeds::dispatch([
        "baseClass" => "\Modules\Iprice\Database\Seeders",
        "seeds" => [
          "CreatePrincipalZoneSeeder"
        ]
      ]);
    }
}
