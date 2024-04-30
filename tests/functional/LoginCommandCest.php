<?php

class LoginCommandCest
{
   public function _fixtures()
   {
        return [
            'persons'   => 'app\tests\fixtures\UserFixture',
        ];
    }

    public function testUserAlreadyExists(\FunctionalTester $I)
    {

        $username = "'josecouves'";
        $name = "'José das Couves'";
        $password = "'123456'";

        $output = $I->runShellCommand("php yii create-user $username $name $password");

        $I->seeInShellOutput('Erro ao criar usuário');
    }

    public function testSuccessfulSaveUser(\FunctionalTester $I)
    {
        $username = "'testuser'";
        $name = "'Test User'";
        $password = "'testuser'";

        $output = $I->runShellCommand("php yii create-user $username $name $password");

        $I->seeInShellOutput('Usuário criado com sucesso.');


    }
}
