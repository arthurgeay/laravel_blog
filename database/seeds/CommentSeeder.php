<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('comments')->delete();

        for($i = 0; $i < 40; $i++) {
            DB::table('comments')->insert([
                'content' => $faker->text(40),
                'created_at' => $faker->dateTime,
                'user_id' => $faker->numberBetween(1, 10),
                'post_id' => $faker->numberBetween(1, 20),
            ]);
        }
    }
}
