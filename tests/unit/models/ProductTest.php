<?php

namespace tests\unit\models;
use app\models\Product;

class ProductTest extends \Codeception\Test\Unit
{
    protected $product;
    protected function setUp(): void
    {
        parent::setUp();
        $this->product = new Product();
        $this->product->name = 'Chave de fenda';


    }

    public function testModelExists()
    {
        $this->assertInstanceOf(Product::class, $this->product);
    }

    public function testUnsucessfulSave()
    {
        $product = new Product();
        $this->assertFalse($product->save());
    }

    public function testSucessfulSave()
    {
        $this->assertTrue($this->product->save());
    }
}