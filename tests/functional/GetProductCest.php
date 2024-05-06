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
}
