<?php

class InputProductCest
{
    public function testReturnJson(FunctionalTester $I)
    {
        $this->inputRequest($I, ['name' => 'Chave de Fenda']);
        $I->seeResponseCodeIs(200);
    }

    public function testInputInvalidPrice(FunctionalTester $I)
    {
        $response = $this->inputRequest($I, ['name' => 'Chave de Fenda', 'price' => 'abc']);
        $I->seeResponseContains('Erro ao cadastrar o produto', $response['message']);
    }

    public function testInputEmptyValues(FunctionalTester $I)
    {
        $response = $this->inputRequest($I, []);
        $I->seeResponseContains('Erro ao cadastrar o produto', $response['message']);
    }

    public function testInputValid(FunctionalTester $I)
    {
        $response = $this->inputRequest($I, ['name' => 'Chave de Fenda', 'price' => 15.00]);
        $I->seeResponseContains('Produto inserido com sucesso', $response['success']);
    }

    protected function inputRequest(FunctionalTester $I, array $params)
    {
        $I->sendPOST('api/product/save', $params);
        return json_decode($I->grabResponse(), true);
    }
}
