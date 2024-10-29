<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

        //vendor create
        User::factory(50)->create([
            'usertype' => 'vendor'
        ])->each(function($user){
            Vendor::factory()->create([
                'user_id' => $user->id
            ]);
        });

        // vendor product add
        $vendors = Vendor::all();

        foreach($vendors as $vendor){
            $productCount = rand(1, 10);

            Product::factory()->count($productCount)
                ->create([
                    'vendor_id' => $vendor->id
                ]);
        }

 
    }
}
