<?php

use Illuminate\Database\Seeder;

class DevSeeder extends Seeder
{
    /**
     * Run development seeds.
     *
     * @return void
     */
    public function run()
    {
        // COMBINE WITH MIGRATE:REFRESH
        // DO NOT RUN THIS IN PRODUCTION

        $faker = Faker\Factory::create("id_ID");

        factory(Agent::class)->create([
            'name' => 'Simful Sample Travel',
            'address' => $faker->streetAddress,
            'city' => $faker->city,
            'state' => $faker->state,
            'country' => 'Indonesia',//$faker->country,
            'phone' => $faker->phoneNumber,
            'max_users' => 5,
            'expires_on' => '2017-01-01',
            'package' => 1,
            'billing_cycle' => 3,
            'settings' => null
        ]);

        factory(User::class)->create([
            'agent_id' => 1,
            'name' => $faker->firstName('female') . ' ' . $faker->lastName,
            'email' => 'admin@simful.com',
            'password' => bcrypt('admin'),
            'remember_token' => str_random(10),
            'user_type' => 1,
        ]);

        factory(User::class)->create([
            'agent_id' => 1,
            'name' => $faker->firstName('female') . ' ' . $faker->lastName,
            'email' => 'demo@simful.com',
            'password' => bcrypt('demo'),
            'remember_token' => str_random(10),
            'user_type' => 1,
        ]);

        factory(User::class)->create(['agent_id' => 1]);
    }
}
