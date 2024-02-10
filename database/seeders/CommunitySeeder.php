<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CommunitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Убедитесь, что в таблице users есть данные
        $users = DB::table('users')->pluck('id')->toArray();

        if (empty($users)) {
            echo "Необходимо сначала заполнить таблицу users.\n";
            return;
        }

        // Массив с русскими названиями и описаниями сообществ
        $communitiesData = [
            ['name' => 'Программирование', 'description' => 'Сообщество для программистов и разработчиков'],
            ['name' => 'Дизайн', 'description' => 'Сообщество для дизайнеров и художников'],
            ['name' => 'Музыка', 'description' => 'Сообщество музыкантов и меломанов'],
            ['name' => 'Фотография', 'description' => 'Сообщество фотографов и фотолюбителей'],
            ['name' => 'Игры', 'description' => 'Сообщество геймеров и игровых разработчиков'],
            ['name' => 'Кулинария', 'description' => 'Сообщество любителей кулинарии и рецептов'],
            ['name' => 'Путешествия', 'description' => 'Сообщество путешественников и любителей приключений'],
            ['name' => 'Кино', 'description' => 'Сообщество киноманов и кинокритиков'],
            ['name' => 'Литература', 'description' => 'Сообщество книголюбов и писателей'],
            ['name' => 'Спорт', 'description' => 'Сообщество спортсменов и фитнес-энтузиастов'],
        ];

        $faker = \Faker\Factory::create();

        foreach ($communitiesData as $communityData) {
            DB::table('communities')->insert([
                'user_id' => $faker->randomElement($users),
                'name' => $communityData['name'],
                'description' => $communityData['description'],
                'slug' => Str::slug($communityData['name']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
