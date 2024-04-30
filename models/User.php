<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class User extends ActiveRecord
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
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord || $this->isAttributeChanged('password_hash')) {
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

}
