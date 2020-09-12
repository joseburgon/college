<?php

use App\User;
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
        User::create([
            'name' => 'Team LVR College',
            'email' => 'team@livingroomcollege.org',
            'password' => 'MarceloGallardo'
        ]);
    }
}
