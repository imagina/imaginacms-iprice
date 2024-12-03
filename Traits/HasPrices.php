<?php

namespace Modules\Iprice\Traits;

class HasPrices
{
  public function getInstances()
  {
    return [
      'relations' => ['prices'],
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
    $prices = $params['bindings']['data']['prices'] ?? null;
    //Validate if model need to sync prices
    if ($prices) {
      //Init the needed repositories
      $priceRepository = app("Modules\Iprice\Repositories\PriceRepository");
      $tariffRepository = app("Modules\Iprice\Repositories\TariffRepository");
      $tariffableRepository = app("Modules\Iprice\Repositories\TariffableRepository");
      //Get the model
      $model = $params['model'];
      //Sync prices
      foreach ($prices as $zone => $price) {
        //update or create the price
        $iprice = $priceRepository->updateOrCreate([
          'entity_type' => get_class($model),
          'entity_id' => $model->id,
          'zone' => $zone
        ], ['price' => $price['value']]);
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
}
