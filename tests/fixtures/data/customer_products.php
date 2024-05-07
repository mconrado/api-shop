<?php
$faker = Faker\Factory::create();

$customerProductMock = [];

for ($customerId = 1; $customerId <= 3; $customerId++) {
    $productsAdded = 0;

    while ($productsAdded < 10) {
        $productId = $faker->numberBetween(1, 30);

        $productExists = false;
        foreach ($customerProductMock as $customerProduct) {
            if ($customerProduct['customer_id'] == $customerId && $customerProduct['product_id'] == $productId) {
                $productExists = true;
                break;
            }
        }

        if (!$productExists) {
            $customerProductMock[] = [
                'customer_id' => $customerId,
                'product_id' => $productId,
            ];
            $productsAdded++;
        }
    }
}

return $customerProductMock;
