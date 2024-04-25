<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m240425_130628_create_product_table_nn_customer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'price' => $this->decimal(10, 2)->notNull()->defaultValue(0),
            'photo' => $this->string(),
        ]);

        $this->createTable('{{%customer_product}}', [
            'customer_id' => $this->integer(),
            'product_id' => $this->integer(),
            'PRIMARY KEY(customer_id, product_id)',
        ]);

        $this->addForeignKey(
            'fk-customer_product-customer_id',
            'customer_product',
            'customer_id',
            'customer',
            'id',
            'CASCADE'
        );

        $this->addForeignKey(
            'fk-customer_product-product_id',
            'customer_product',
            'product_id',
            'product',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%customer_product}}');
        $this->dropTable('{{%product}}');
    }
}
