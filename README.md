# Acme Widget Co Sales System

## Overview

This project is a proof of concept for the sales system of Acme Widget Co, a leading provider of made-up widgets. The system implements a basket with various functionalities such as adding products, calculating total costs, applying delivery charge rules, and special offers.

## Requirements

The project includes the following key components:
- **Composer** for dependency management
- **PHPUnit** for unit and integration tests
- **PHPStan** for static analysis
- **Docker** and **Docker Compose** for environment setup
- **Dependency Injection** and **Strategy Pattern** for clean code architecture

## Installation

1. **Clone the repository:**
    ```bash
    git clone https://github.com/harrysleetgit/acme-widget-task.git
    cd acme-widget-task
    ```

2. **Install dependencies:**
    ```bash
    composer install
    ```

3. **Run PHPStan:**
    ```bash
    vendor/bin/phpstan analyse
    ```

4. **Run PHPUnit tests:**
    ```bash
    vendor/bin/phpunit tests
    ```

## Usage

The `Basket` class is the core of the sales system. Here are the key methods:

- **`add(string $productCode): void`** - Adds a product to the basket by its code.
- **`total(): float`** - Returns the total cost of the basket, considering delivery and offer rules.

### Example

Here is an example of how to use the `Basket` class:

```php
<?php

require 'vendor/autoload.php';

use AcmeWidgetCo\Basket;
use AcmeWidgetCo\Product;
use AcmeWidgetCo\Offer;

// Define the product catalogue
$catalogue = [
    'R01' => new Product('R01', 32.95),
    'G01' => new Product('G01', 24.95),
    'B01' => new Product('B01', 7.95)
];

// Define delivery charge rules
$deliveryChargeRules = [
    ['threshold' => 50, 'charge' => 4.95],
    ['threshold' => 90, 'charge' => 2.95],
    ['threshold' => PHP_FLOAT_MAX, 'charge' => 0.00] // Free delivery for orders of $90 or more
];

// Define special offers
$offers = [
    new Offer('R01', 16.475) // Buy one red widget, get the second half price
];

// Initialize the basket
$basket = new Basket($catalogue, $deliveryChargeRules, $offers);

// Add products to the basket
$basket->add('B01');
$basket->add('G01');

// Get the total cost
$total = $basket->total();
echo "Total: $total"; // Should output 37.85
