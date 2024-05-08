<?php
$productMock = [];

for ($i = 1; $i <= 30; $i++) {
    $mock = [
        'name' => 'Produto ' . $i,
        'price' => rand(10, 100),
    ];

    if ($i <= 5) {
        $mock['photo'] = 'https://example.com/photo' . $i . '.jpg';
    }

    $productMock['product' . $i] = $mock;
}

return $productMock;
