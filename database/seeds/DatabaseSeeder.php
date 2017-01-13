<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $this->call('DevSeeder');
        $this->call('AccountingSeeder');
        $this->call('DemoSeeder');
    }
}
