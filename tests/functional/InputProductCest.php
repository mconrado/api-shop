<?php
use app\helpers\TestAuthHelper;

class InputProductCest
{
    protected $url = 'api/product/save';
    protected $modeRequest = 'Post';

    public function _before(FunctionalTester $I)
    {
        if (empty(TestAuthHelper::$authToken)) {
            TestAuthHelper::$authToken = TestAuthHelper::authenticateWithToken($I);
        }
    }

    public function _fixtures()
    {
        return [
            'users' => 'app\tests\fixtures\UserFixture',
        ];
    }

    public function testReturnJson(FunctionalTester $I)
    {
        TestAuthHelper::sendRequest($I, $this->url, $this->modeRequest, ['name' => 'Chave de Fenda']);
        $I->seeResponseIsJson();
    }

    public function testInputInvalidPrice(FunctionalTester $I)
    {
        $response = TestAuthHelper::sendRequest(
            $I,
            $this->url,
            $this->modeRequest,
            ['name' => 'Chave de Fenda', 'price' => 'abc']
        );

        $I->seeResponseContains('Erro ao cadastrar o produto', $response['message']);
    }

    public function testInputEmptyValues(FunctionalTester $I)
    {
        $response = TestAuthHelper::sendRequest($I, $this->url, $this->modeRequest);
        $I->seeResponseContains('Erro ao cadastrar o produto', $response['message']);
    }

        public function testInputValid(FunctionalTester $I)
        {
            $response = TestAuthHelper::sendRequest($I, $this->url, $this->modeRequest, ['name' => 'Chave de Fenda', 'price' => 15.00]);
            $I->seeResponseContains('Produto inserido com sucesso', $response['success']);
        }
}
