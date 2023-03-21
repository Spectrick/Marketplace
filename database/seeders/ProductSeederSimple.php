<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductSeederSimple extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        $categories = [
            [
                'name' => 'Электроника',
            ],
            [
                'name' => 'Одежда',
            ],
            [
                'name' => 'Детские игрушки',
            ],
            [
                'name' => 'Для кухни',
            ],
            [
                'name' => 'Дом и сад',
            ],
            [
                'name' => 'Спортивные товары',
            ],
            [
                'name' => 'Aвтомобильные запчасти',
            ],
            [
                'name' => 'Здоровье и красота',
            ],
            [
                'name' => 'Книги',
            ],
            [
                'name' => 'Мебель',
            ],
            [
                'name' => 'Бытовая химия',
            ],
            [
                'name' => 'Игры и консоли',
            ],
            [
                'name' => 'Обувь',
            ],
            [
                'name' => 'Напитки и еда',
            ],
            [
                'name' => 'Другое',
            ],
        ];
        Category::insert($categories);

        $faker = Faker::create();

        for ($i = 1; $i <= 50; $i++) {

            $random_id = mt_rand(1, count($categories));

            DB::table('products')->insert([
                'name' => $faker->text(15),
                'description' => $faker->text(150),
                'price' => mt_rand(500, 100000),
                'published' => true,
                'category_id' => $random_id,
            ]);

            $thumbnail_url = $faker->imageUrl(300, 300, true);

            $thumbnail = 'data:image/png;base64,' . base64_encode(file_get_contents($thumbnail_url));

            DB::table('images')->insert([
                'product_id' => $i,
                'alt' => $faker->text(15),
                'url' => json_encode($faker->imageUrl(800, 600, true)),
                'thumbnail' => $thumbnail,
            ]);
        }
    }
}
