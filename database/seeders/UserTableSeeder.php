<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = [
            [
                'id' => 1,
                'name' => 'Alice Evergarden',
                'email' => 'alice@mydrive.id',
                'password' => bcrypt('aldio1234'),
                'remember_token' => null
            ]
        ];

        User::insert($user);
    }
}
