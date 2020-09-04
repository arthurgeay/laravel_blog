<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('posts')->delete();

        for($i = 0; $i < 20; $i++) {
            DB::table('posts')->insert([
                'title' => $faker->text(40),
                'content' => $faker->paragraph,
                'created_at' => $faker->dateTime,
                'user_id' => $faker->numberBetween(1, 10)
            ]);
        }
    }
}
