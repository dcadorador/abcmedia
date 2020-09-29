<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $user = new \App\Models\User();
        $user->name = "Administrator";
        $user->email = 'admin@application.com';
        $user->password = \Hash::make('password');
        $user->status = 1;
        $user->save();
    }
}
