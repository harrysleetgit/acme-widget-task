<?php

namespace AcmeWidgetCo;

class Basket
{
  private $products = [];
  private $catalogue = [];
  private $deliveryChargeRules = [];
  private $offers = [];

  public function __construct(array $catalogue, array $deliveryChargeRules, array $offers)
  {
    $this->catalogue = $catalogue;
    $this->deliveryChargeRules = $deliveryChargeRules;
    $this->offers = $offers;
  }

  public function add(string $productCode): void
  {
    if (isset($this->catalogue[$productCode])) {
      $this->products[] = $this->catalogue[$productCode];
    }
  }

  public function total(): float
  {
    $total = 0.0;
    foreach ($this->products as $product) {
      $total += $product->getPrice();
    }

    foreach ($this->offers as $offer) {
      if ($offer->appliesTo($this->products)) {
        $total = $offer->apply($this->products);
      }
    }

    $reversed_arr = array_reverse($this->deliveryChargeRules);
    foreach ($reversed_arr as $key => $rule) {
      if ($total < $rule['threshold']) {
        $total += $reversed_arr[$key-1]['charge'];
        break;
      }
    }
    return floor($total * 100) / 100;
  }
}
