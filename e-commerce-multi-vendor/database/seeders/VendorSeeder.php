<?php

namespace Database\Seeders;

use App\Models\Vendors;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vendors::factory(100)->create();
    }
}
