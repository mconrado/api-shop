<?php
namespace tests\unit\models;

use app\models\User;

class UserTest extends \Codeception\Test\Unit
{
    public function testModelExists()
    {
        $user = new User();
        $this->assertInstanceOf(User::class, $user);
    }

    public function testUnsucessfulSave()
    {
        $user = new User();
        $this->assertFalse($user->save());
    }

    public function testSucessfulSave()
    {
        $user = new User();
        $user->username = 'josecouves';
        $user->password_hash = '123456';
        $this->assertTrue($user->save(), print_r($user->getErrors(), true));
    }

    public function testPasswordIsEncrypted()
    {
        $user = new User();
        $user->username = 'josecouves';
        $user->password_hash = '123456';
        $user->save();

        $savedUser = User::findOne(['username' => 'josecouves']);

        $this->assertFalse($savedUser->password_hash === '123456');
    }

    public function testUserAlreadyExists()
    {
        $user = new User();
        $user->username = 'josecouves';
        $user->password_hash = '123456';
        $user->save();

        $user2 = new User();
        $user2->username = 'josecouves';
        $user2->password_hash = '456789';

        $this->assertFalse($user2->save());
    }
}
