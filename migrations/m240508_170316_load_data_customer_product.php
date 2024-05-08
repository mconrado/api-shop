<?php

use yii\db\Migration;

/**
 * Class m240508_170316_load_data_customer_product
 */
class m240508_170316_load_data_customer_product extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('customer_product', ['customer_id', 'product_id'], [
            // Customer 1
            [1, 5],
            [1, 12],
            [1, 8],
            [1, 25],
            [1, 18],
            [1, 3],
            [1, 29],
            [1, 10],
            [1, 21],
            [1, 7],
            // Customer 2
            [2, 15],
            [2, 22],
            [2, 9],
            [2, 27],
            [2, 20],
            [2, 4],
            [2, 28],
            [2, 11],
            [2, 23],
            [2, 6],
            // Customer 3
            [3, 15],
            [3, 22],
            [3, 9],
            [3, 27],
            [3, 20],
            [3, 4],
            [3, 28],
            [3, 11],
            [3, 23],
            [3, 6],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('customer_product', ['customer_id' => [1, 2, 3]]);
    }
}
