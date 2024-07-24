<?php

namespace AcmeWidgetCo\Tests;

use AcmeWidgetCo\{Offer, Product};
use PHPUnit\Framework\TestCase;

class OfferTest extends TestCase
{
  private $products;

  protected function setUp(): void
  {
    $this->products = [
      new Product('R01', 32.95),
      new Product('R01', 32.95),
      new Product('G01', 24.95),
    ];
  }

  public function testOfferAppliesTo()
  {
    $offer = new Offer('R01', 16.475);

    $this->assertTrue($offer->appliesTo($this->products));

    $productsWithoutOffer = [
      new Product('G01', 24.95),
      new Product('B01', 7.95),
    ];

    $this->assertFalse($offer->appliesTo($productsWithoutOffer));
  }

  public function testOfferApply()
  {
    $offer = new Offer('R01', 16.475);

    $this->assertEquals(74.37, $offer->apply($this->products));

    $productsWithoutOffer = [
      new Product('G01', 24.95),
      new Product('B01', 7.95),
    ];

    $this->assertEquals(32.90, $offer->apply($productsWithoutOffer));
  }
}
