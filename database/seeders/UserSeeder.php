<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    public function run(Faker $faker)
    {
        DB::table('users')->insert([
            'name' => $faker->name(),
            'email' => 'admin',
            'password' => Hash::make('admin'), // password
            'remember_token' => Str::random(10),
            'phone' => '0567995775',
            'alt_phone' => '0567995775',
            'mode' => 'Default',
            'verification_code' => '2907',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
