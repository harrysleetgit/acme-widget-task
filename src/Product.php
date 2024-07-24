<?php

namespace AcmeWidgetCo;

class Product
{
  private $code;
  private $price;

  public function __construct(string $code, float $price)
  {
    $this->code = $code;
    $this->price = $price;
  }

  public function getCode(): string
  {
    return $this->code;
  }

  public function getPrice(): float
  {
    return $this->price;
  }
}
