<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('users')->delete();

        for($i = 0; $i < 10; $i++) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'email' => 'test'.$i.'@example.com',
                'password' => bcrypt('test'),
                'api_token' => Str::random(60)
            ]);
        }
    }
}
