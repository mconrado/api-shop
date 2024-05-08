<?php

namespace app\tests\fixtures;

use yii\test\ActiveFixture;

class CustomerProductsFixture extends ActiveFixture
{
    public $modelClass = 'app\models\CustomerProduct';

    public $dataFile = '@app/tests/fixtures/data/customer_products.php';

    public $depends = [
        'app\tests\fixtures\CustomerFixture',
        'app\tests\fixtures\ProductFixture',
    ];
}