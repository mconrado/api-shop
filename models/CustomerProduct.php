<?php
namespace app\models;

use yii\db\ActiveRecord;

class CustomerProduct extends ActiveRecord
{
    public static function tableName()
    {
        return 'customer_product';
    }

    public function rules()
    {
        return [
            [['customer_id', 'product_id'], 'required'],
        ];
    }
}
