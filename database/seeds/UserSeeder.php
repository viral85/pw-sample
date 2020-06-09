<?php

use App\User;
use App\Comment;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // We can use factories for multiple records
        $faker = Faker::create();
        
        $user = User::FirstOrCreate([
            'name' => $faker->name,
            'password' => "720DF6C2482218518FA20FDC52D4DED7ECC043AB" //This password is given in test, Or else we can store it bcrypt()
        ]);
        
        // Add comment
        Comment::create([
            'user_id' => $user->id,
            'comment' => "First Comment", //$faker->paragraph,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}