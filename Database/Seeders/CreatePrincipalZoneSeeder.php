<?php

namespace Modules\Iprice\Database\Seeders;

use Illuminate\Database\Seeder;

class CreatePrincipalZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $zoneRepository = app('Modules\Iprice\Repositories\ZoneRepository');
      $existZone = $zoneRepository->getItem('mainprice', json_decode(json_encode(['filter' => ['field' => 'system_name']])));

      if(!isset($existZone)) {
        $existZone = $zoneRepository->getItem(1, json_decode(json_encode(['filter' => ['field' => 'default']])));
      }

      if(!isset($existZone))
      {
        $languages = array_keys(\LaravelLocalization::getSupportedLocales());
        $createZone = [
          'system_name' => 'mainprice',
          'default' => 1,
          'status' => 1
        ];
        //Set current field into value of the newField
        foreach ($languages as $lang) {
          $createZone[$lang] = [
            'title' => trans('iprice::zones.title.mainprice')
          ];
        }
        $zoneRepository->create($createZone);
      }
    }
}
