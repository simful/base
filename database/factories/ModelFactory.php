<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
$faker = Faker\Factory::create('id_ID');

$factory->define(Agent::class, function (Faker\Generator $fakerd) use ($faker) {
    return [
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'country' => 'Indonesia', // $faker->country,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'website' => $faker->url,
        'max_users' => $faker->randomElement([2, 5, 10]),
        'expires_on' => $faker->dateTimeBetween($startDate = 'now', $endDate = '+2 months'),
        'package' => $faker->randomElement(['Professional', 'Super', 'Ultimate']),
        'billing_cycle' => $faker->randomElement([3, 6, 12])
    ];
});

$factory->define(User::class, function (Faker\Generator $fakerd) use ($faker) {
    return [
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'email' => $faker->safeEmail,
        'password' => bcrypt('admin'),
        'address' => $faker->streetAddress,
        'phone' => $faker->phoneNumber,
        'remember_token' => str_random(10),
        'user_type' => 0
    ];
});


$factory->define(Contact::class, function (Faker\Generator $fakerd) use ($faker) {
    return [
        //'agent_id' => $faker->numberBetween(1, 5),
        'name' => $faker->firstName . ' ' . $faker->lastName,
        'address' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'country' => 'Indonesia', // $faker->country,
        'phone' => $faker->phoneNumber,
        'email' => $faker->email,
        'website' => $faker->url,
        'type' => $faker->randomElement(['Individual', 'Group', 'Corporate', 'Non-profit', 'Other'])
    ];
});

$factory->define(Invoice::class, function (Faker\Generator $fakerd) use ($faker) {
    return [
        'user_id' => $faker->numberBetween(1, 3),
        'date' => $faker->dateTimeBetween($startDate = '-10 days', $endDate = '+20 days'),
        'due_date' => $faker->dateTimeBetween($startDate = '-10 days', $endDate = '+20 days'),
        'status' => $faker->randomElement(['Draft', 'Sent', 'Completed']),
        'notes' => $faker->text,
        'amount_paid' => 0,
        'paid' => $faker->randomElement([true, false]),
    ];
});

$factory->define(InvoiceDetail::class, function (Faker\Generator $fakerd) use ($faker) {
    $price = $faker->numberBetween(1, 500) * 1000;
    return [
        'product_id' => $faker->numberBetween(1, 10),
        'description' => $faker->sentence,
        'qty' => $faker->randomElement([1,1,1,1,2,2,2,3,3,4]),
        'price' => $price + ($price * rand(1, 100) / 100),
    ];
});

$factory->define(Transaction::class, function (Faker\Generator $fakerd) use ($faker) {
    return [
        'description' => $faker->text
    ];
});

$factory->define(TransactionDetail::class, function (Faker\Generator $fakerd) use ($faker) {
    $flag = $faker->randomElement([true, false]);
    $amount = $faker->numberBetween(1, 500) * 1000;
    return [
        'debit' => $flag ? $amount : 0,
        'credit' => !$flag ? $amount : 0,
    ];
});

$factory->define(LetterGuarantee::class, function (Faker\Generator $fakerd) use ($faker) {
    return [
        'supplier_id' => $faker->numberBetween(1, 15),
        'number' => $faker->numberBetween(1, 40000),
        'ref_number' => $faker->numberBetween(1, 40000),
        'remarks' => $faker->sentence
    ];
});

$factory->define(LetterGuaranteeDetail::class, function (Faker\Generator $fakerd) use ($faker) {
    return [
        'letter_id' => $faker->numberBetween(1, 10),
        'description' => $faker->sentence,
        'price' => $faker->numberBetween(1, 1000) * 1000,
        'currency' => 'IDR'
    ];
});

$factory->define(Refund::class, function (Faker\Generator $fakerd) use ($faker) {
    return [
        'invoice_id' => $faker->numberBetween(1, 20),
        'amount' => $faker->numberBetween(1, 1000) * 1000,
        'refund_fee' => $faker->numberBetween(1, 50) * 1000,
        'reason' => $faker->sentence
    ];
});

$factory->define(Product::class, function (Faker\Generator $fakerd) use ($faker) {
    $buy_price = $faker->numberBetween(1, 1000) * 1000;
    return [
        'name' => $faker->randomElement(['Mouse', 'Headset', 'Keyboard', 'Speaker', 'USB', 'HDD']) . ' ' .
                    $faker->randomElement(['Razer', 'Logitech', 'SonicGear', 'Genius', 'Asus', 'Acer', 'Dell', 'Toshiba']) . ' ' .
                    $faker->randomElement(['Black', 'Blue', 'Red', 'Green']),
        'buy_price' => $buy_price,
        'sell_price' =>  $buy_price + ($buy_price * $faker->numberBetween(1, 30) * 0.01),
        'description' => $faker->realText,
    ];
});

$factory->define(Expense::class, function (Faker\Generator $fakerd) use ($faker) {
    return [
        'source_account_id' => $faker->randomElement([1010, 1040, 1050, 1060, 1070, 1080]),
        'expense_account_id' => $faker->randomElement([9010, 9020, 9030, 9040, 9050, 9060, 9070]),
        'description' => $faker->sentence,
        'amount' => $faker->numberBetween(1, 1000 * 1000)
    ];
});
