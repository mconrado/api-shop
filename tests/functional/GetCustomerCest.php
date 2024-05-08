<?php

use app\helpers\TestAuthHelper;

class GetCustomerCest
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
            'customers'   => 'app\tests\fixtures\CustomerFixture',
            'users' => 'app\tests\fixtures\UserFixture',
        ];
    }
    public function testReturnIsJson(FunctionalTester $I)
    {
        TestAuthHelper::sendRequest($I, 'api/customer');
        $I->seeResponseContainsJson();
    }

    public function testGetWithoutTokenAuth(FunctionalTester $I)
    {
        TestAuthHelper::sendRequest($I,'api/customer', 'Get', [], true);
        $I->seeResponseJsonMatchesXpath('//name[. = "Unauthorized"]');
    }

    public function testPageHasTenRecords(FunctionalTester $I)
    {
        $response = TestAuthHelper::sendRequest($I, 'api/customer');
        \PHPUnit_Framework_Assert::assertEquals(10, count($response));
    }

    public function testAccessPageTwoIsOk(FunctionalTester $I)
    {
        $response = TestAuthHelper::sendRequest($I, 'api/customer/2');
        \PHPUnit_Framework_Assert::assertEquals(10, count($response));
    }
}
