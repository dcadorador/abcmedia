<?php

use Illuminate\Database\Seeder;
use App\Models\InfusionsoftAccount;
use Faker\Factory as Faker;
use App\Helpers\Helper;
use Illuminate\Support\Facades\DB;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create('App\Models\InfusionsoftLog');

        for($i = 1 ; $i <= 50 ; $i++){

            $account = InfusionsoftAccount::orderBy(DB::raw('RAND()'))
                ->first();

            DB::table('infusionsoft_logs')->insert([
                'app_name' => $account->app_name,
                'auth_key' => $account->auth_key,
                'data' => $faker->paragraph(4),
                'created_at' => now()->subDays(rand(100,1000)),
                'updated_at' => now()->subDays(rand(100,1000))
            ]);
        }
    }
}
