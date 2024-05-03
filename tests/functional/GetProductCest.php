<?php

class GetProductCest
{
    protected static $authToken;

    public function _before(FunctionalTester $I)
    {
        if (empty(self::$authToken)) {
            self::$authToken = $this->authenticateWithToken($I);
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
        $this->getRequest($I, 'api/product');
        $I->seeResponseContainsJson();
    }

    public function testGetWithoutTokenAuth(FunctionalTester $I)
    {
        self::$authToken = '';
        $this->getRequest($I, 'api/product');
        $I->seeResponseJsonMatchesXpath('//name[. = "Unauthorized"]');
    }

    public function testPageHasTenRecords(FunctionalTester $I)
    {
        $response = $this->getRequest($I, 'api/product');
        \PHPUnit_Framework_Assert::assertEquals(10, count($response));
    }

    public function testAccessPageTwoIsOk(FunctionalTester $I)
    {
        $response = $this->getRequest($I, 'api/product/2');
        \PHPUnit_Framework_Assert::assertEquals(10, count($response));
    }

    protected function getRequest(FunctionalTester $I, $url)
    {
        $I->haveHttpHeader('Authorization', self::$authToken);
        $I->sendGet($url);
        return json_decode($I->grabResponse(), true);
    }

    protected function authenticateWithToken(FunctionalTester $I)
    {
        $I->sendPOST('auth/login', [
            'username' => 'josecouves',
            'password' => '123456',
        ]);

        self::$authToken = $I->grabHttpHeader('Authorization');

        return self::$authToken;
    }
}
