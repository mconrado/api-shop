<?php

use yii\db\Migration;

/**
 * Class create_customer_table
 */
class m240424_180421_create_customer_table extends Migration
{
    public function safeUp()
    {
        $this->createTable('customer', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'cpf' => $this->string()->notNull(),
            'zipcode' => $this->string(),
            'address_street' => $this->string(),
            'number' => $this->integer(10),
            'city' => $this->string(),
            'state' => $this->string(),
            'complement' => $this->string(),
            'photo' => $this->string(),
            'gender' => $this->string(1),
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('customer');
    }
}
