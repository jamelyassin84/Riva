<?php

namespace Database\Seeders;

use App\Models\Seller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SellerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            'type' => 'seller',
            'profile_id' => '',
            'card_number' => '',
            'name' => 'Jamel Eid Yassin',
            'email' => 'admin',
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

        $seller = [
            'user_id' => $user->id,
            'avatar' => '',
            'mode' => '',
            'google' => '',
            'facebook' => '',
            'apple' => '',
            'verification_code' => '',
            'password' => Hash::make('admin'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];

        Seller::create($seller);
    }
}
