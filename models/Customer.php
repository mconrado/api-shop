<?php

namespace app\models;
use yii\db\ActiveRecord;
use yiibr\brvalidator\CpfValidator;

class Customer extends ActiveRecord
{
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
