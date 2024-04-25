<?php

namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    public static function tableName()
    {
        return 'product';
    }

    public function rules()
    {
        return [
            [['price'], 'default', 'value' => 0],
            [['name', 'price'], 'required'],
            [['price'], 'number'],
        ];
    }

    public function getCustomers()
    {
        return $this->hasMany(Customer::class, ['id' => 'customer_id'])
            ->viaTable('customer_product', ['product_id' => 'id']);
    }
}
