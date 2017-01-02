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

        factory(Contact::class)->create(['name' => 'Garuda Indonesia']);
        factory(Contact::class)->create(['name' => 'Lion Air']);
        factory(Contact::class)->create(['name' => 'AirAsia']);
        factory(Contact::class)->create(['name' => 'Batik Air']);
        factory(Contact::class)->create(['name' => 'Citilink']);
        factory(Contact::class)->create(['name' => 'Sriwijaya Air']);
        factory(Contact::class)->create(['name' => 'TransNusa']);
        factory(Contact::class, 15)->create();

        AccountGroup::insert([
            ['id' => 1, 'name' => 'Aktiva Lancar', 'type' => 'Permanent', 'position' => 'Debit'],
            ['id' => 2, 'name' => 'Aktiva Tetap', 'type' => 'Permanent', 'position' => 'Debit'],
            ['id' => 3, 'name' => 'Liabilitas Lancar', 'type' => 'Permanent', 'position' => 'Credit'],
            ['id' => 4, 'name' => 'Liabilitas Tak Lancar', 'type' => 'Permanent', 'position' => 'Credit'],
            ['id' => 5, 'name' => 'Modal', 'type' => 'Permanent', 'position' => 'Credit'],
            ['id' => 6, 'name' => 'Prive', 'type' => 'Temporary', 'position' => 'Debit'],
            ['id' => 7, 'name' => 'Pendapatan', 'type' => 'Temporary', 'position' => 'Credit'],
            ['id' => 8, 'name' => 'Harga Pokok Penjualan', 'type' => 'Temporary', 'position' => 'Debit'],
            ['id' => 9, 'name' => 'Biaya Operasional', 'type' => 'Temporary', 'position' => 'Debit']
        ]);

        $accounts = [
            ['account_group_id' => 1, 'name' => 'Kas'],
            ['account_group_id' => 1, 'name' => 'Piutang Dagang', 'has_reference' => true],
            ['account_group_id' => 1, 'name' => 'Deposit', 'has_reference' => true],
            ['account_group_id' => 2, 'name' => 'Peralatan'],
            ['account_group_id' => 2, 'name' => 'Akumulasi Penyusutan Peralatan'],
            ['account_group_id' => 2, 'name' => 'Tanah'],
            ['account_group_id' => 2, 'name' => 'Bangunan'],
            ['account_group_id' => 2, 'name' => 'Akumulasi Penyusutan Bangunan'],
            ['account_group_id' => 2, 'name' => 'Kendaraan'],
            ['account_group_id' => 2, 'name' => 'Akumulasi Penyusutan Kendaraan'],
            ['account_group_id' => 2, 'name' => 'Perlengkapan Kantor'],
            ['account_group_id' => 2, 'name' => 'Sewa Dibayar Dimuka'],
            ['account_group_id' => 3, 'name' => 'Hutang Dagang', 'has_reference' => true],
            ['account_group_id' => 3, 'name' => 'Pajak'],
            ['account_group_id' => 3, 'name' => 'Hutang Bank'],
            ['account_group_id' => 3, 'name' => 'Hutang Bank Jangka Panjang'],
            ['account_group_id' => 3, 'name' => 'Hutang Pajak'],
            ['account_group_id' => 3, 'name' => 'Hutang Gaji'],
            ['account_group_id' => 3, 'name' => 'Hutang PPh'],
            ['account_group_id' => 3, 'name' => 'Hutang PPN'],
            ['account_group_id' => 3, 'name' => 'PPN Keluaran'],
            ['account_group_id' => 3, 'name' => 'PPN Masukan'],
            ['account_group_id' => 5, 'name' => 'Modal'],
            ['account_group_id' => 6, 'name' => 'Prive'],
            ['account_group_id' => 6, 'name' => 'Ikhtisar Laba-rugi'],
            ['account_group_id' => 7, 'name' => 'Penjualan'],
            ['account_group_id' => 7, 'name' => 'Penjualan Jasa'],
            ['account_group_id' => 7, 'name' => 'Penjualan Lain-lain'],
            ['account_group_id' => 7, 'name' => 'Penghasilan Lain-lain'],
            ['account_group_id' => 8, 'name' => 'Harga Pokok Penjualan'],
            ['account_group_id' => 9, 'name' => 'Beban Gaji'],
            ['account_group_id' => 9, 'name' => 'Beban Perlengkapan'],
            ['account_group_id' => 9, 'name' => 'Beban Sewa'],
            ['account_group_id' => 9, 'name' => 'Beban Penyusutan'],
            ['account_group_id' => 9, 'name' => 'Beban Bunga'],
            ['account_group_id' => 9, 'name' => 'Biaya Operasional'],
            ['account_group_id' => 9, 'name' => 'Biaya Lain-lain'],
        ];

        $gid = 0;
        $count = 1;

        foreach ($accounts as $account) {
            if ($gid == $account['account_group_id'])
            {
                $count++;
            }
            else {
                $count = 1;
                $gid = $account['account_group_id'];
            }

            $account['id'] = $account['account_group_id'] . '0' . $count . '0';
            Account::create($account);
        }

        factory(Contact::class, 30)->create()->each(function($c) use ($faker) {
            $c->invoices()->saveMany(factory(Invoice::class, 2)->create(['customer_id' => $c->id])->each(function ($i) use ($faker) {
                $price_nett = $faker->numberBetween(1, 500) * 1000;
                $price = $price_nett + $faker->numberBetween(1, 50) * 1000;

                $i->details()->saveMany(factory(InvoiceDetail::class, 2)->make(['price' => $price, 'price_nett' => $price_nett]));

                // assume accounts
                $receiveOn = $faker->randomElement([1010, 1020]);
                $sale = $faker->randomElement([7010, 7010, 7010, 7010, 7020, 7020, 7030]);
                $hpp = 8010;
                $deposit = 1030;

                $transaction = Transaction::create(['user_id' => 1, 'description' => 'Penjualan Invoice #' . $i->id]);
                $transaction->details()->saveMany([
                    new TransactionDetail(['account_id' => $receiveOn, 'debit' => $price, 'reference_id' => $i->customer_id, 'ref_type' => 'customer']),
                    new TransactionDetail(['account_id' => $sale, 'credit' => $price, 'reference_id' => $i->customer_id, 'ref_type' => 'customer'])
                ]);

                $transaction_hpp = Transaction::create(['user_id' => 1, 'description' => 'Pembelian untuk Invoice #' . $i->id]);
                $ref = $faker->numberBetween(1, 20);
                $transaction_hpp->details()->saveMany([
                    new TransactionDetail(['account_id' => $hpp, 'debit' => $price_nett, 'reference_id' => $ref, 'ref_type' => 'company']),
                    new TransactionDetail(['account_id' => $deposit, 'credit' => $price_nett, 'reference_id' => $ref, 'ref_type' => 'company'])
                ]);
            }));
        });

        Tax::create([
            'code' => 'PPN',
            'name' => 'Pajak Pertambahan Nilai',
            'rate' => 0.1
        ]);

        Tax::create([
            'code' => 'PPh',
            'name' => 'Pajak Penghasilan',
            'rate' => 0.05
        ]);
    }
}
