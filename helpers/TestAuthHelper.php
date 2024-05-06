<?php
namespace app\helpers;
use FunctionalTester;

class TestAuthHelper
{
    public static $authToken;

    public static function sendRequest(FunctionalTester $I, string $url, string $mode = 'Get', array $params = [], bool $cleanHeaders = false)
    {
        $methodName = 'send' . $mode;

        $I->haveHttpHeader('Authorization', self::$authToken);

        if($cleanHeaders) {
            $I->deleteHeader('Authorization');
        }

        $I->$methodName($url, $params);
        return json_decode($I->grabResponse(), true);
    }

    public static function authenticateWithToken(FunctionalTester $I)
    {
        $I->sendPost('auth/login', [
            'username' => 'josecouves',
            'password' => '123456',
        ]);

        self::$authToken = $I->grabHttpHeader('Authorization');

        return self::$authToken;
    }
}