<?php

namespace AcmeWidgetCo\Tests;

use AcmeWidgetCo\{Basket, Product, Offer};
use PHPUnit\Framework\TestCase;

class BasketTest extends TestCase
{
  public function testBasketTotal()
  {
    $catalogue = [
      'R01' => new Product('R01', 32.95),
      'G01' => new Product('G01', 24.95),
      'B01' => new Product('B01', 7.95),
    ];

    $deliveryChargeRules = [
      ['threshold' => 90, 'charge' => 0.00],
      ['threshold' => 50, 'charge' => 2.95],
      ['threshold' => 0, 'charge' => 4.95],
    ];

    $offers = [
      new Offer('R01', 16.475),
    ];

    $basket = new Basket($catalogue, $deliveryChargeRules, $offers);

    $basket->add('B01');
    $basket->add('G01');
    $this->assertEquals(37.85, $basket->total());

    $basket = new Basket($catalogue, $deliveryChargeRules, $offers);
    $basket->add('R01');
    $basket->add('R01');
    $this->assertEquals(54.37, $basket->total());

    $basket = new Basket($catalogue, $deliveryChargeRules, $offers);
    $basket->add('R01');
    $basket->add('G01');
    $this->assertEquals(60.85, $basket->total());

    $basket = new Basket($catalogue, $deliveryChargeRules, $offers);
    $basket->add('B01');
    $basket->add('B01');
    $basket->add('R01');
    $basket->add('R01');
    $basket->add('R01');
    $this->assertEquals(98.27, $basket->total());
  }
}
