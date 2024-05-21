<?php

namespace App\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Test cases for Entity class Product.
 */
class ProductTest extends TestCase
{
    /**
     * @var Product $product
     */
    protected $product;

    /**
     * tests' set up
     */
    public function setUp(): void
    {
        $this->product = new Product();
    }

    /**
     * Construct object and verify the type.
     */
    public function testCreateObject(): void
    {
        $this->assertInstanceOf("\App\Entity\Product", $this->product);
        $this->assertNull($this->product->getId());
    }

    /**
     * test setter and getter method for name.
     */
    public function testSetAndGetName(): void
    {
        $name = "test name";
        $this->product->setName($name);
        $this->assertEquals($name, $this->product->getName());
        $this->assertIsString($this->product->getName());
    }

    /**
     * test setter and getter method for value.
     */
    public function testSetAndGetValue(): void
    {
        $value = random_int(0, 50);

        $this->product->setValue($value);
        $this->assertEquals($value, $this->product->getValue());
        $this->assertIsInt($this->product->getValue());
    }
}
