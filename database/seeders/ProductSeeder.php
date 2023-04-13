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

            $categoryRandomId = mt_rand(1, count($categories));

            switch ($categoryRandomId) {
                case 1:
                    $imageContent = Storage::get('public/images/image_seeder/' . 'electronics_product_0' . mt_rand(1, 4) . '.png');
                    break;
                case 2:
                    $imageContent = Storage::get('public/images/image_seeder/' . 'clothes_0' . mt_rand(1, 4) . '.png');
                    break;
                case 3:
                    $imageContent = Storage::get('public/images/image_seeder/' . 'child_toy_0' . mt_rand(1, 4) . '.png');
                    break;
                case 4:
                    $imageContent = Storage::get('public/images/image_seeder/' . 'kitchen_product_0' . mt_rand(1, 4) . '.png');
                    break;
                case 5:
                    $imageContent = Storage::get('public/images/image_seeder/' . 'home_and_garden_0' . mt_rand(1, 4) . '.png');
                    break;
                case 6:
                    $imageContent = Storage::get('public/images/image_seeder/' . 'sport_product_0' . mt_rand(1, 4) . '.png');
                    break;
                case 7:
                    $imageContent = Storage::get('public/images/image_seeder/' . 'automobile_parts_0' . mt_rand(1, 4) . '.png');
                    break;
                case 8:
                    $imageContent = Storage::get('public/images/image_seeder/' . 'beauty_and_health_care_0' . mt_rand(1, 4) . '.png');
                    break;
                case 9:
                    $imageContent = Storage::get('public/images/image_seeder/' . 'book_0' . mt_rand(1, 4) . '.png');
                    break;
                case 10:
                    $imageContent = Storage::get('public/images/image_seeder/' . 'furniture_0' . mt_rand(1, 4) . '.png');
                    break;
                case 11:
                    $imageContent = Storage::get('public/images/image_seeder/' . 'household_chemicals_0' . mt_rand(1, 4) . '.png');
                    break;
                case 12:
                    $imageContent = Storage::get('public/images/image_seeder/' . 'video_game_0' . mt_rand(1, 4) . '.png');
                    break;
                case 13:
                    $imageContent = Storage::get('public/images/image_seeder/' . 'shoes_0' . mt_rand(1, 4) . '.png');
                    break;
                case 14:
                    $imageContent = Storage::get('public/images/image_seeder/' . 'drink_product_0' . mt_rand(1, 6) . '.png');
                    break;
                case 15:
                    $imageContent = Storage::get('public/images/image_seeder/' . 'other_0' . mt_rand(1, 4) . '.png');
                    break;
            }

            $imageName = time() . uniqid() . '.png';

            $imageUrl = 'images/products/' . $imageName;

            Storage::disk('public')->put('images/products/' . $imageName, $imageContent);

            $thumbnail = ImageResize::make($imageContent)->resize(250, 250, function ($constraint) {
                return $constraint->aspectRatio();
            });

            $thumbnailBase64 = (string) $thumbnail->encode('data-url');

            DB::table('products')->insert([
                'name' => substr($faker->text(15), 0, -1),
                'description' => $faker->text(200),
                'price' => mt_rand(500, 100000),
                'published' => true,
                'category_id' => $categoryRandomId,
            ]);

            DB::table('images')->insert([
                'product_id' => $i,
                'alt' => $faker->text(15),
                'url' => json_encode($imageUrl),
                'thumbnail' => $thumbnailBase64,
            ]);

            DB::table('currencies')->insert([
                'id' => [
                    'RUB',
                    'USD',
                    'EUR'
                ],
                'name' => [
                    'Российский рубль',
                    'Доллар США',
                    'Евро'
                ],
                'price' => [
                    '1',
                    currencyConvert('USD', 'RUB', 1, 4),
                    currencyConvert('EUR', 'RUB', 1, 4)
                ],
                'active' => true,
            ]);
        }
    }
}
