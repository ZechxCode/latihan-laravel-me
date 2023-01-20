<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect([
            [
                'name' => 'John Doe',
                'email' => 'john@test.test',
                'password' => 'password',
            ],
            [
                'name' => 'Jane Doe',
                'email' => 'jane@test.test',
                'password' => 'password',
            ],
            [
                'name' => 'Jack Doe',
                'email' => 'jack@test.test',
                'password' => 'password',
            ],
        ])->each(function ($user) {
            User::create($user);
        });
    }
}
