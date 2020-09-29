<?php

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Helpers\Helper;

class AccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = User::first();

        $faker = Faker::create('App\Models\InfusionsoftAccount');

        for($i = 1 ; $i <= 10 ; $i++){
            DB::table('infusionsoft_accounts')->insert([
                'user_id' => $user->id,
                'app_name' => $faker->word(),
                'access_token' => Helper::quickRandom(90),
                'refresh_token' => Helper::quickRandom(90),
                'auth_key' => Helper::quickRandom(90),
                'created_at' => now()->subDays(rand(100,1000)),
                'updated_at' => now()->subDays(rand(100,1000))
            ]);
        }

    }
}
