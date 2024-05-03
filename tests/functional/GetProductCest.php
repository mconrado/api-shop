<?php


class GetProductCest
{
    public function _fixtures()
    {
        return [
            'persons'   => 'app\tests\fixtures\ProductFixture',
        ];
    }
    public function testReturnJson(FunctionalTester $I)
    {
        $this->getRequest($I, 'api/product');
        $I->seeResponseContainsJson();
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
        $I->sendGet($url);
        return json_decode($I->grabResponse(), true);
    }
}
