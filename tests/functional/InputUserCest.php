<?php

use app\models\User;

class InputUserCest
{
    public function _fixtures()
    {
        return [
            'persons'   => 'app\tests\fixtures\UserFixture',
        ];
    }

    public function testPost(\FunctionalTester $I)
    {
        $I->sendPOST('api/auth/login', ['username' => 'usuario', 'password' => 'senha']);
        $I->seeResponseCodeIs(200);
    }

    public function testReturnJson(\FunctionalTester $I)
    {
        $I->sendPOST('api/auth/login', ['username' => 'usuario', 'password' => 'senha']);
        $I->seeResponseIsJson();
    }

    public function testUserNotFound(\FunctionalTester $I)
    {
        $I->sendPOST('api/auth/login', ['username' => 'usuario', 'password' => 'senha']);
        $I->seeResponseContainsJson(['error' => 'Usuário ou senha inválidos']);
    }

   

    public function testUserFound(\FunctionalTester $I)
    {

        $savedUser = User::findOne(['username' => 'josecouves']);

        $I->sendPOST('api/auth/login', [
            'username' => $savedUser->username,
            'password' => '123456'
        ]);

        $I->seeResponseMatchesJsonType(['token' => 'string:!empty']);
    }

}
