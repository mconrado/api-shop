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
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer()->notNull(),
            'product_id' => $this->integer()->notNull(),
        ]);

        $this->createIndex(
            'idx-customer_product-customer_id-product_id',
            'customer_product',
            ['customer_id', 'product_id'], false
        );



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-customer_product-customer_id-product_id', 'customer_product');
        $this->dropTable('{{%customer_product}}');
        $this->dropTable('{{%product}}');
    }
}
