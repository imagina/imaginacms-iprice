<?php

namespace Modules\Iprice\Traits;

use Modules\Iprice\Repositories\PriceRepository;

class HasPrices
{
  public function getInstances()
  {
    return [
      'relations' => ['prices'],
      'events' => [
        'createdWithBindings' => 'createdEvent',
        'updatedWithBindings' => 'updateEvent',
      ]
    ];
  }

  public function createdEvent($params)
  {
    $prices = $params['bindings']['data']['prices'] ?? null;
    if (isset($prices)) {
      $model = $params['model'];
      $priceRepository = app(PriceRepository::class);
      foreach ($prices as $zone => $price) {
        $data = [
          'price' => $price,
          'entity_type' => get_class($model),
          'entity_id' => $model->id,
          'zone' => $zone
        ];
        $priceRepository->create($data);
      }
    }
  }

  public function updateEvent($params)
  {
    $prices = $params['bindings']['data']['prices'] ?? null;
    if (isset($prices)) {
      $model = $params['model'];
      $priceRepository = app(PriceRepository::class);
      foreach ($prices as $zone => $price) {
        $priceRepository->updateOrCreate(['entity_type' => get_class($model), 'entity_id' => $model->id, 'zone' => $zone],
          ['price' => $price]);
      }
    }
  }


  public function prices($model)
  {
    return $model->morphMany('Modules\Iprice\Entities\Price', 'entity');
  }
}