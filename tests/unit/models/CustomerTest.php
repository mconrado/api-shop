<?php

namespace tests\unit\models;
use app\models\Customer;


class CustomerTest extends \Codeception\Test\Unit
{
    protected $customer;
    protected function setUp(): void
    {
        parent::setUp();
        $this->customer = new Customer();
        $this->customer->name = 'Jose das Couves';
        $this->customer->cpf = '52681177006';
    }
    public function testModelExists()
    {
        $this->assertInstanceOf(Customer::class, $this->customer);
    }
    
    public function testCPFInvalid()
    {
        $this->customer->cpf = '11111111111';
        $this->assertFalse($this->customer->validate(['cpf']));
    }

    public function testCPFValid()
    {
        $this->assertTrue($this->customer->validate(['cpf']));
    }

    public function testUnsucessfulSave()
    {
        $this->customer->cpf = '';
        $this->assertFalse($this->customer->save());
    }

    public function testSuccessfulSave()
    {
        $this->assertTrue($this->customer->save(), print_r($this->customer->getErrors(), true));
    }
}
