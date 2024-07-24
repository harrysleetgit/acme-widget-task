<?php

namespace AcmeWidgetCo;

class Offer
{
  private $productCode;
  private $discountedPrice;

  public function __construct(string $productCode, float $discountedPrice)
  {
    $this->productCode = $productCode;
    $this->discountedPrice = $discountedPrice;
  }

  public function appliesTo(array $products): bool
  {
    $productCount = 0;
    foreach ($products as $product) {
      if ($product->getCode() === $this->productCode) {
        $productCount++;
      }
    }
    return $productCount > 1;
  }

  public function apply(array $products): float
  {
    $total = 0.0;
    $applied = false;
    foreach ($products as $product) {
      if ($product->getCode() === $this->productCode && !$applied) {
        $total += floor($this->discountedPrice * 100) / 100;
        $applied = true;
      } else {
        $total += $product->getPrice();
      }
    }
    return $total;
  }
}
