<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Vendors;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Vendors>
 */
class VendorsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Vendors::class;

    public function definition(): array
    {
        $users = User::where('role',1)->get();
        $total_users = count($users) - 1;
        return [
            'company_name' => fake()->name(),
            'address' => fake()->address(),
            'logo' => fake()->imageUrl(),
            'status' => 'pending',
            'user_id' => $users[rand(0, $total_users)]->id
        ];
    }
}
