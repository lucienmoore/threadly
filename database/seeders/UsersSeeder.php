<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 20; $i++) {
            DB::table('users')->insert([
                'name' => $faker->unique()->userName, // Генерация уникального имени пользователя
                'email' => $faker->unique()->safeEmail, // Генерация уникального email
                'email_verified_at' => now(),
                'password' => Hash::make('password'), // Используйте Hash::make() для хеширования паролей
                'avatar' => 'avatars/user.svg', // Опционально, можно генерировать различные аватары
                'is_admin' => $faker->boolean, // Случайное булево значение
                'is_banned' => $faker->boolean, // Случайное булево значение
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
