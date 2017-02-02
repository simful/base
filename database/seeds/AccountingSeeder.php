<?php

use Illuminate\Database\Seeder;

class AccountingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
	{
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
            ['account_group_id' => 1, 'name' => 'Bank Mandiri'],
            ['account_group_id' => 1, 'name' => 'Bank BCA'],
            ['account_group_id' => 1, 'name' => 'Bank BRI'],
            ['account_group_id' => 1, 'name' => 'Bank BNI'],
            ['account_group_id' => 1, 'name' => 'Bank Permata'],
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

            $account['id'] = ($account['account_group_id'] * 1000) + ($count * 10);
            Account::create($account);
        }

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
