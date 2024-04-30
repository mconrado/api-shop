<?php
namespace tests\unit\models;

use app\models\User;

class UserTest extends \Codeception\Test\Unit
{
    protected $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = new User();
        $this->user->name = 'José das Couves';
        $this->user->username = 'josecouves';
        $this->user->password_hash = '123456';
    }
    public function testModelExists()
    {
        $this->assertInstanceOf(User::class, $this->user);
    }

    public function testUnsucessfulSave()
    {
        $user = new User();
        $this->assertFalse($user->save());
    }

    public function testSucessfulSave()
    {
        $this->assertTrue($this->user->save(), print_r($this->user->getErrors(), true));
    }

    public function testPasswordIsEncrypted()
    {
        $this->user->save();
        $savedUser = User::findOne(['username' => 'josecouves']);

        $this->assertFalse($savedUser->password_hash === '123456');
    }

    public function testUserAlreadyExists()
    {
        $this->user->save();

        $user2 = new User();
        $user2->username = 'josecouves';
        $user2->password_hash = '456789';

        $this->assertFalse($user2->save());
    }

    public function testFindUserByUsername()
    {
        $this->user->save();

        $userSaved = User::findByUsername('josecouves');
        $this->assertNotNull($userSaved);
    }
}
