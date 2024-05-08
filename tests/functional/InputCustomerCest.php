<?php
use app\helpers\TestAuthHelper;

class InputCustomerCest
{
    protected $url = 'api/customer/save';
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
        $I->sendPOST('api/customer/save');
        $I->seeResponseIsJson();
    }

    public function testInputInvalid(FunctionalTester $I)
    {
        $response = TestAuthHelper::sendRequest($I, $this->url, $this->modeRequest,
            ['name' => 'Customer Test', 'cpf' => 'abc']);
        $I->seeResponseContains('Erro ao inserir cliente.', $response['message']);
    }

    public function testInputValid(FunctionalTester $I)
    {
        $faker = Faker\Factory::create('pt_BR');
        $cpf = $faker->cpf;

        $response = TestAuthHelper::sendRequest(
            $I,
            $this->url,
            $this->modeRequest,
            ['name' => 'Customer test', 'cpf' => $cpf]
        );

        $I->seeResponseContains('Cliente cadastrado!', $response['success']);
    }



}