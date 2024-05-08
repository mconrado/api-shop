<?php
$customerMock = [];

for ($i = 1; $i <= 30; $i++) {
    $faker = Faker\Factory::create('pt_BR');

    $mock = [
        'name' => $faker->name,
        'cpf' => $faker->cpf,
    ];

    $customerMock['customer' . $i] = $mock;
}

return $customerMock;
