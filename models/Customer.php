<?php

namespace app\models;
use yii\db\ActiveRecord;
use yiibr\brvalidator\CpfValidator;

class Customer extends ActiveRecord
{
    const GENDER_MALE = 'M';
    const GENDER_FEMALE = 'F';

    public static function tableName()
    {
        return 'customer';
    }

    public function rules()
    {
        return [
            [['name', 'cpf'], 'required'],
            ['cpf', CpfValidator::className()],
            [
                ['name', 'cpf', 'zipcode', 'address_street', 'city', 'state',
                'complement', 'photo', 'gender'], 'string'
            ],
            ['number', 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'cpf' => 'CPF',
            'zipcode' => 'ZIP Code',
            'address_street' => 'Street',
            'number' => 'Number',
            'city' => 'City',
            'state' => 'State',
            'complement' => 'Complement',
            'photo' => 'Photo',
            'gender' => 'Gender',
        ];
    }
}
