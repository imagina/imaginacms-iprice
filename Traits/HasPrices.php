<?php

namespace Modules\Iprice\Traits;

class HasPrices
{
  public function getInstances()
  {
    return [
      'relations' => ['prices'],
      'methods' => ['getPriceAttribute', 'getDefaultZone'],
      'events' => [
        'createdWithBindings' => 'syncPrices',
        'updatedWithBindings' => 'syncPrices',
      ]
    ];
  }

  /**
   * Mehtod to sync prices
   *
   * @param $params
   * @return void
   */
  public function syncPrices($params)
  {
    //Get the model
    $model = $params['model'];
    $prices = $params['bindings']['data']['prices'] ?? null;
    $price = $params['bindings']['data']['price'] ?? null;
    $priceRepository = app("Modules\Iprice\Repositories\PriceRepository");

    //Validate if model need to sync prices
    if ($prices) {
      //Init the needed repositories
      $tariffRepository = app("Modules\Iprice\Repositories\TariffRepository");
      $tariffableRepository = app("Modules\Iprice\Repositories\TariffableRepository");
      //Sync prices
      foreach ($prices as $price) {
        $zoneId = $price['zone_id'] ?? null;
        $zoneSystemName = $price['zone_system_name'] ?? null;

        if(!isset($zoneId) && isset($zoneSystemName)) {
          $zoneRepository = app('Modules\Iprice\Repositories\ZoneRepository');
          $zone = $zoneRepository->getItem($zoneSystemName, json_decode(json_encode(['filter' => ['field' => 'system_name']])));
          $zoneId = $zone->id ?? null;
        }
        $iprice = null;
        if($zoneId) {
          //update or create the price
          $iprice = $priceRepository->updateOrCreate([
            'entity_type' => get_class($model),
            'entity_id' => $model->id,
            'zone_id' => $zoneId
          ], ['value' => $price['value']]);
        }

        if(!isset($iprice)) return;
        //Sync the price tariffs
        foreach (($price['tariffs'] ?? []) as $tariff) {
          if (isset($tariff['id']) || isset($tariff['system_name'])) {
            //Get tariff Id
            $tariffId = $tariff['id'] ?? null;
            //Search the tariff by systemName
            if (!$tariffId) {
              $itariff = $tariffRepository->getItem(
                $tariff['system_name'],
                json_decode(json_encode(['filter' => ['field' => 'system_name']]))
              );
              $tariffId = $itariff->id ?? null;
            }
            //Update or Create the tariff
            if ($tariffId) {
              $tariffableRepository->updateOrCreate([
                'tariff_id' => $tariffId,
                'entity_type' => get_class($iprice),
                'entity_id' => $iprice->id,
              ], ['value' => $tariff['value'] ?? 0]);
            }
          }
        }
      }
    } else if(isset($price)) {
      $defaultZone = $model->getDefaultZone();
      $zoneId = $defaultZone->id ?? null;

      //Ignore if not exist default zone
      if($zoneId) {
        //update or create the price
        $priceRepository->updateOrCreate([
          'entity_type' => get_class($model),
          'entity_id' => $model->id,
          'zone_id' => $zoneId
        ], ['value' => $price]);
      }
    }
  }


  /**
   * Relation Prices
   *
   * @param $model
   * @return mixed
   */
  public function prices($model)
  {
    return $model->morphMany('Modules\Iprice\Entities\Price', 'entity');
  }

  public function getDefaultZone()
  {
    $zoneRepository = app('Modules\Iprice\Repositories\ZoneRepository');
    return $zoneRepository->getItem(1, json_decode(json_encode(['filter' => ['field' => 'default']])));
  }

  public function getPriceAttribute()
  {
    $modelRelations = array_keys($this->getRelations());
    $price = 0;
    //Get price by default zone
    if (in_array('prices', $modelRelations)) {
      $defaultZone = $this->getDefaultZone();
      if ($defaultZone) {
        $defaultPrice = $this->prices->where('zone_id', $defaultZone->id)->first();
        $price = $defaultPrice->price ?? 0;
      }
    }
    //Response
    return $price;
  }
}
