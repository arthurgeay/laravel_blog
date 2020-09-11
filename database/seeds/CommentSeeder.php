<?php

use App\Comment;
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

        for($i = 0; $i < 100; $i++) {
            $postId = $faker->numberBetween(1, 20);

            $comment = Comment::create([
                'name' => $faker->name,
                'content' => $faker->text(40),
                'created_at' => $faker->dateTime,
                'post_id' => $postId,
                'reports' => $faker->boolean() ? $faker->numberBetween(1, 15) : null
            ]);

            if($faker->boolean(65)) {
                DB::table('comments')->insert([
                    'name' => $faker->name,
                    'content' => $faker->text(40),
                    'created_at' => $faker->dateTime,
                    'post_id' => $postId,
                    'reports' => $faker->boolean() ? $faker->numberBetween(1, 15) : null,
                    'parent_id' => $comment->id
                ]);
            }

        }
    }
}
