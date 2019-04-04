<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create test user 
        DB::table('users')->insert([
            'name' => 'John Doe',
            'email' => 'john.doe@gmail.com',
            'password' => bcrypt('password'),
            'slug' => "john-doe",
            'created_at' => \Carbon\Carbon::now(),
        ]);
        DB::table('users')->insert([
            'name' => 'John Doe2',
            'email' => 'john.doe2@gmail.com',
            'password' => bcrypt('password'),
            'slug' => "john-doe-2",
            'created_at' => \Carbon\Carbon::now(),
        ]);
    }
}
