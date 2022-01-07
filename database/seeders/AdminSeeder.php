<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{

    public function run()
    {
        $user = [
            'type' => 'admin',
            'profile_id' => '',
            'card_number' => '',
            'name' => 'Digital Brand Work Technology',
            'email' => 'info@digitalbrandworktechnology.com',
            'country_code' => 'AE',
            'phone' => '0567995775',
            'alt_phone' => '0567995775',
            'payment_method' => '',
            'is_logged_in' => false,
            'card_number' => '',
            'currency' => 'AED',
            'area_code' => '+971',
            'remember_token' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
        $user = User::create($user);

        $admin = [
            'user_id' => $user->id,
            'password' => 'admin',
            'country' => 'United Arab Emirates',
            'application_fee_amount' => 3,
            'avatar' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        Admin::create($admin);
    }
}
