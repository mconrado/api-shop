<?php

use yii\db\Migration;

/**
 * Class m240508_162529_load_data_products
 */
class m240508_162529_load_data_products extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('product', ['name', 'price'], [
            ['Chave de Fenda Phillips', 9.99],
            ['Martelo de Carpinteiro', 19.99],
            ['Parafuso de Aço Inoxidável', 1.99],
            ['Trena de 5 Metros', 14.50],
            ['Prego Galvanizado', 0.25],
            ['Broca para Concreto', 7.99],
            ['Serra Circular', 49.99],
            ['Luvas de Proteção', 5.50],
            ['Fita Isolante', 2.75],
            ['Nível a Laser', 89.99],
            ['Alicate Universal', 12.99],
            ['Escada de Alumínio 6 Degraus', 59.99],
            ['Lixa para Madeira', 3.50],
            ['Tubo de PVC 1 Polegada', 1.75],
            ['Vassoura de Nylon', 8.25],
            ['Tinta Látex Branca 1 Litro', 15.99],
            ['Argamassa para Rejunte', 4.50],
            ['Pincel de Pintura 2 Polegadas', 2.99],
            ['Carrinho de Mão', 39.99],
            ['Furadeira de Impacto', 69.99],
            ['Chave Inglesa 10 Polegadas', 8.99],
            ['Broxa de Pintura', 4.75],
            ['Saco de Cimento 50kg', 22.50],
            ['Martelo de Borracha', 6.99],
            ['Fechadura para Porta', 17.25],
            ['Serra de Esquadria', 79.99],
            ['Torneira para Cozinha', 14.50],
            ['Rolo de Pintura Antirrespingo', 3.99],
            ['Tijolo Cerâmico', 0.50],
            ['Luminária de Emergência', 29.99],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete('product', ['name' => [
            'Chave de Fenda Phillips',
            'Martelo de Carpinteiro',
            'Parafuso de Aço Inoxidável',
            'Trena de 5 Metros',
            'Prego Galvanizado',
            'Broca para Concreto',
            'Serra Circular',
            'Luvas de Proteção',
            'Fita Isolante',
            'Nível a Laser',
            'Alicate Universal',
            'Escada de Alumínio 6 Degraus',
            'Lixa para Madeira',
            'Tubo de PVC 1 Polegada',
            'Vassoura de Nylon',
            'Tinta Látex Branca 1 Litro',
            'Argamassa para Rejunte',
            'Pincel de Pintura 2 Polegadas',
            'Carrinho de Mão',
            'Furadeira de Impacto',
            'Chave Inglesa 10 Polegadas',
            'Broxa de Pintura',
            'Saco de Cimento 50kg',
            'Martelo de Borracha',
            'Fechadura para Porta',
            'Serra de Esquadria',
            'Torneira para Cozinha',
            'Rolo de Pintura Antirrespingo',
            'Tijolo Cerâmico',
            'Luminária de Emergência',
        ]]);
    }
}
