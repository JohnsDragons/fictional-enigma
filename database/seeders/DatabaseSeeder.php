<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Discount;
use App\Models\Order;
use App\Models\Product;
use App\Models\SpecialDay;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $faker = Factory::create();

        foreach (range(1, 10) as $i) {
            Customer::create([
                'name' => $faker->name,
            ]);
        }

        foreach (range(1, 100) as $i) {
            Product::create([
                'name' => $faker->word,
                'price_in_cents' => $faker->numberBetween(100, 9999),
            ]);
        }

        foreach (range(1, 10) as $i) {
            $order = Order::create([
                'customer_id' => Customer::inRandomOrder()->value('id'),
            ]);

            // Pick 5 random product IDs
            $productIds = Product::inRandomOrder()->limit(5)->pluck('id');

            // Attach with random quantity (optional)
            foreach ($productIds as $productId) {
                $order->products()->attach($productId, [
                    'quantity' => $faker->numberBetween(1, 3),
                ]);
            }
        }

        //Adding just the three discounts mentioned in the task, not making this dynamically for now
        Discount::create(['name' => 'Order > 100', 'type' => 'above_subtotal', 'threshold' => 100, 'percentage_amount' => 10]);
        Discount::create(['name' => 'Customer has placed more than 5 orders', 'type' => 'after_number_of_orders', 'threshold' => 5, 'percentage_amount' => 5]);
        Discount::create(['name' => 'Holiday discount', 'type' => 'special_day', 'percentage_amount' => 20]);

        foreach (range(1, 10) as $i) {
            SpecialDay::create([
                'date' => $faker->date,
            ]);
        }
    }
}
