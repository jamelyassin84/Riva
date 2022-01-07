<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(CountrySeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(SellerSeeder::class);
        $this->call(ProductSeeder::class);
    }
}
