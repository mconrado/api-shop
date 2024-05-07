<?php

use app\helpers\TestAuthHelper;

class GetProductCest
{
    public function _before(FunctionalTester $I)
    {
        if (empty(TestAuthHelper::$authToken)) {
            TestAuthHelper::$authToken = TestAuthHelper::authenticateWithToken($I);
        }
    }
    public function _fixtures()
    {
        return [
            'products'   => 'app\tests\fixtures\ProductFixture',
            'users' => 'app\tests\fixtures\UserFixture',
            'customer_products' => 'app\tests\fixtures\CustomerProductsFixture',
        ];
    }
    public function testReturnIsJson(FunctionalTester $I)
    {
        TestAuthHelper::sendRequest($I, 'api/product');
        $I->seeResponseContainsJson();
    }

    public function testGetWithoutTokenAuth(FunctionalTester $I)
    {
        TestAuthHelper::sendRequest($I,'api/product', 'Get', [], true);
        $I->seeResponseJsonMatchesXpath('//name[. = "Unauthorized"]');
    }

    public function testPageHasTenRecords(FunctionalTester $I)
    {
        $response = TestAuthHelper::sendRequest($I, 'api/product');
        \PHPUnit_Framework_Assert::assertEquals(10, count($response));
    }

    public function testAccessPageTwoIsOk(FunctionalTester $I)
    {
        $response = TestAuthHelper::sendRequest($I, 'api/product/2');
        \PHPUnit_Framework_Assert::assertEquals(10, count($response));
    }

    public function testReturnGetProductCustomerIsJson(FunctionalTester $I)
    {
        TestAuthHelper::sendRequest($I, 'api/customer/99/products');
        $I->seeResponseContainsJson();
    }

    public function testCustomerNotFound(FunctionalTester $I)
    {
        TestAuthHelper::sendRequest($I, 'api/customer/99/products');
        $I->seeResponseJsonMatchesXpath('//message[. = "Cliente não encontrado."]');
    }

    public function testCustomerWithoutProducts(FunctionalTester $I)
    {
        $response = TestAuthHelper::sendRequest($I, 'api/customer/6/products');
        \PHPUnit_Framework_Assert::assertNotEquals(10, count($response));
    }

    public function testCustomerWithProducts(FunctionalTester $I)
    {
        $response = TestAuthHelper::sendRequest($I, 'api/customer/1/products');
        \PHPUnit_Framework_Assert::assertEquals(10, count($response));
    }
}
