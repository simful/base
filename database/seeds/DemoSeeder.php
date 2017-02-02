<?php

use Illuminate\Database\Seeder;

class DemoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Runs on demo database.
        $faker = Faker\Factory::create("id_ID");

        factory(Product::class, 10)->create();
        factory(Expense::class, 20)->create();

        factory(Contact::class)->create(['name' => 'Garuda Indonesia']);
        factory(Contact::class)->create(['name' => 'Lion Air']);
        factory(Contact::class)->create(['name' => 'AirAsia']);
        factory(Contact::class)->create(['name' => 'Batik Air']);
        factory(Contact::class)->create(['name' => 'Citilink']);
        factory(Contact::class)->create(['name' => 'Sriwijaya Air']);
        factory(Contact::class)->create(['name' => 'TransNusa']);
        factory(Contact::class, 15)->create();

        factory(Contact::class, 30)->create()->each(function($c) use ($faker) {
            $c->invoices()->saveMany(factory(Invoice::class, 2)->create(['customer_id' => $c->id])->each(function ($i) use ($faker) {
                $price_nett = $faker->numberBetween(1, 500) * 1000;
                $price = $price_nett + ($price_nett * rand(1, 100) / 100);

                $i->details()->saveMany(factory(InvoiceDetail::class, 2)->make(['price' => $price, 'price_nett' => $price_nett]));

                // assume accounts
                $receiveOn = $faker->randomElement([1010, 1020]);
                $sale = $faker->randomElement([7010, 7010, 7010, 7010, 7020, 7020, 7030]);
                $hpp = 8010;
                $deposit = 1030;

                $transaction = Transaction::create(['user_id' => 1, 'description' => 'Penjualan Invoice [#' . $i->id . '] ' . $i->customer->name]);
                $transaction->details()->saveMany([
                    new TransactionDetail(['account_id' => $receiveOn, 'debit' => $price, 'reference_id' => $i->customer_id, 'ref_type' => 'customer']),
                    new TransactionDetail(['account_id' => $sale, 'credit' => $price, 'reference_id' => $i->customer_id, 'ref_type' => 'customer'])
                ]);

                $transaction_hpp = Transaction::create(['user_id' => 1, 'description' => 'Pembelian untuk Invoice [#' . $i->id . '] ' . $i->customer->name]);
                $ref = $faker->numberBetween(1, 20);
                $transaction_hpp->details()->saveMany([
                    new TransactionDetail(['account_id' => $hpp, 'debit' => $price_nett, 'reference_id' => $ref, 'ref_type' => 'company']),
                    new TransactionDetail(['account_id' => $deposit, 'credit' => $price_nett, 'reference_id' => $ref, 'ref_type' => 'company'])
                ]);
            }));
        });
    }
}
