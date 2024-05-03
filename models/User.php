<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'password_hash', 'name'], 'required'],
            ['username', 'unique'],
            ['password_hash', 'string'],

        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert))
        {
            if ($this->isNewRecord || $this->isAttributeChanged('password_hash'))
            {
                $this->password_hash = Yii::$app->security->generatePasswordHash($this->password_hash);
            }
            return true;
        }
        return false;
    }
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Busca o usuário no cache com base no token de acesso
        $user = Yii::$app->cache->get('user_' . $token);

        if ($user)
        {
            return $user;
        }

        return null;
    }

    public function getId()
    {
        return $this->id;
    }

    public static function findIdentity($id)
    {

    }


    public function getAuthKey()
    {

    }

    public function validateAuthKey($authKey)
    {

    }


}
