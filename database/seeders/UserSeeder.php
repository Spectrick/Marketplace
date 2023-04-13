<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {

        for ($i = 1; $i <= 10; $i++) {

            $faker = Faker::create();

            $thumbnailUrl = $faker->imageUrl(300, 300, 'people', true);

            $thumbnail = 'data:image/png;base64,' . base64_encode(file_get_contents($thumbnailUrl));

            $email = $faker->userName() . '@' . 'maildomain.com';

            DB::table('users')->insert([
                'created_at' => now(),
                'updated_at' => now(),
                'name' => $faker->name(),
                'email' => $email,
                'password' => bcrypt('userpassword'),
                'avatar' => $thumbnail,
            ]);
        }
    }
}
