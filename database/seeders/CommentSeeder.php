<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\User;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        $products = Product::all();

        foreach ($products as $product) {
            $users = User::inRandomOrder()->where('id', '>', 1)->get();

            foreach ($users as $user) {
                DB::table('comments')->insert([
                    'created_at' => now(),
                    'updated_at' => now(),
                    'product_id' => $product->id,
                    'user_id' => $user->id,
                    'rating' => mt_rand(1,5),
                    'message' => 'Отзыв о товаре ' . $product->name . ' ' . $faker->text(250),
                ]);
            }
        }
    }
}
