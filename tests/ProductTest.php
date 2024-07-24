<?php

namespace AcmeWidgetCo\Tests;

use AcmeWidgetCo\Product;
use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
  public function testProductCreation()
  {
    $product = new Product('R01', 32.95);

    $this->assertEquals('R01', $product->getCode());
    $this->assertEquals(32.95, $product->getPrice());
  }

  public function testProductCode()
  {
    $product = new Product('G01', 24.95);

    $this->assertEquals('G01', $product->getCode());
  }

  public function testProductPrice()
  {
    $product = new Product('B01', 7.95);

    $this->assertEquals(7.95, $product->getPrice());
  }
}
