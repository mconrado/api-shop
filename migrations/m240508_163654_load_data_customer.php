<?php

use yii\db\Migration;

/**
 * Class m240508_163654_load_data_customer
 */
class m240508_163654_load_data_customer extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('customer', ['name', 'cpf'], [
            ['Ana Silva', '479.219.540-30'],
            ['José Santos', '173.920.480-82'],
            ['Maria Oliveira', '091.357.410-40'],
            ['Pedro Souza', '021.275.950-76'],
            ['Carla Costa', '714.957.730-00'],
            ['Lucas Pereira', '842.511.000-93'],
            ['Juliana Almeida', '918.763.920-37'],
            ['Rafael Lima', '660.168.040-02'],
            ['Amanda Ferreira', '026.809.380-62'],
            ['Marcos Gomes', '731.666.440-16'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('customer', ['cpf' => [
            '479.219.540-30',
            '173.920.480-82',
            '091.357.410-40',
            '021.275.950-76',
            '714.957.730-00',
            '842.511.000-93',
            '918.763.920-37',
            '660.168.040-02',
            '026.809.380-62',
            '731.666.440-16',
        ]]);
    }
}
