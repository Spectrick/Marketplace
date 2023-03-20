<?php

namespace Database\Seeders;

use App\Models\Category;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as ImageResize;

class ProductSeeder extends Seeder
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

        for ($i = 1; $i <= 100; $i++) {

            $category_random_id = mt_rand(1, count($categories));

            switch ($category_random_id) {
                case 1:
                    $image_content = Storage::get('public/images/image_seeder/' . 'electronics_product_0' . mt_rand(1, 4) . '.png');
                    break;
                case 2:
                    $image_content = Storage::get('public/images/image_seeder/' . 'clothes_0' . mt_rand(1, 4) . '.png');
                    break;
                case 3:
                    $image_content = Storage::get('public/images/image_seeder/' . 'child_toy_0' . mt_rand(1, 4) . '.png');
                    break;
                case 4:
                    $image_content = Storage::get('public/images/image_seeder/' . 'kitchen_product_0' . mt_rand(1, 4) . '.png');
                    break;
                case 5:
                    $image_content = Storage::get('public/images/image_seeder/' . 'home_and_garden_0' . mt_rand(1, 4) . '.png');
                    break;
                case 6:
                    $image_content = Storage::get('public/images/image_seeder/' . 'sport_product_0' . mt_rand(1, 4) . '.png');
                    break;
                case 7:
                    $image_content = Storage::get('public/images/image_seeder/' . 'automobile_parts_0' . mt_rand(1, 4) . '.png');
                    break;
                case 8:
                    $image_content = Storage::get('public/images/image_seeder/' . 'beauty_and_health_care_0' . mt_rand(1, 4) . '.png');
                    break;
                case 9:
                    $image_content = Storage::get('public/images/image_seeder/' . 'book_0' . mt_rand(1, 4) . '.png');
                    break;
                case 10:
                    $image_content = Storage::get('public/images/image_seeder/' . 'furniture_0' . mt_rand(1, 4) . '.png');
                    break;
                case 11:
                    $image_content = Storage::get('public/images/image_seeder/' . 'household_chemicals_0' . mt_rand(1, 4) . '.png');
                    break;
                case 12:
                    $image_content = Storage::get('public/images/image_seeder/' . 'video_game_0' . mt_rand(1, 4) . '.png');
                    break;
                case 13:
                    $image_content = Storage::get('public/images/image_seeder/' . 'shoes_0' . mt_rand(1, 4) . '.png');
                    break;
                case 14:
                    $image_content = Storage::get('public/images/image_seeder/' . 'drink_product_0' . mt_rand(1, 6) . '.png');
                    break;
                case 15:
                    $image_content = Storage::get('public/images/image_seeder/' . 'other_0' . mt_rand(1, 4) . '.png');
                    break;
            }

            $image_name = time() . uniqid() . '.png';

            $image_url = 'images/products/' . $image_name;

            Storage::disk('public')->put('images/products/' . $image_name, $image_content);

            $thumbnail = ImageResize::make($image_content)->resize(250, 250, function ($constraint) {
                return $constraint->aspectRatio();
            });

            $thumbnail_base64 = (string) $thumbnail->encode('data-url');

            DB::table('products')->insert([
                'name' => $faker->text(15),
                'description' => $faker->text(200),
                'price' => mt_rand(500, 100000),
                'published' => true,
                'category_id' => $category_random_id,
            ]);

            DB::table('images')->insert([
                'product_id' => $i,
                'alt' => $faker->text(15),
                'url' => json_encode($image_url),
                'thumbnail' => $thumbnail_base64,
            ]);
        }
    }
}
