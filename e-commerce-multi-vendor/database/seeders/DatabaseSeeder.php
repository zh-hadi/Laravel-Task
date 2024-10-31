<?php

namespace Database\Seeders;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'user',
        //     'email' => 'user@gmail.com',
        // ]);
        $categoryList = ['shirt', 'pant', 'colth', 't-shirt', 'it', 'toy'];
        foreach($categoryList as $category){
            Category::factory()->create(['name' => $category]);
        }

        // create vendor user
        $users = User::factory(50)->create([
            'role' => 1
        ]);

        // vendor product add
        $categorys = Category::all();
        $categoryLength = count($categorys) - 1;
        foreach($users as $user){
            $addProduct = rand(10, 20);

            for($i = 0; $i<$addProduct; $i++){
                Product::factory()->create([
                    'user_id' => $user->id,
                    'category_id' => $categorys[rand(0, $categoryLength)]->id
                ]);
            }
        }

        // create customer and cart
        $customers = User::factory(500)->create(['role' => 2]);

        foreach($customers as $customer){
            Cart::factory()->create([
                'user_id' => $customer->id
            ]);
        }

        // add customer cart items
        $carts = Cart::all();
        foreach($carts as $cart){
            $cartItem = rand(0, 5);

            $products = Product::all();
            $productLength = count($products) - 1;
            for($i = 0; $i <$cartItem; $i++){
                CartItem::factory()->create([
                    'cart_id' => $cart->id,
                    'product_id' => $products[rand(0, $productLength)]->id,
                    'quantity' => 1
                ]);
            }
        }


        // customer order 

            for($i = 0; $i<100; $i++){
                Order::factory()->create([
                    'user_id' => $customers[rand(51, 450)]->id,
                    'total_amount' => rand(50, 500)
                ]);
            }

            $orders = Order::all();
            $products = Product::all();
            $productLength = count($products) - 1;
            foreach($orders as $order){
                OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'product_id' => $products[rand(0, $productLength)]->id,
                    'quantity' => 1
                ]);
            }

    }
}
