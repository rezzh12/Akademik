<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CreateUserSeeder extends Seeder
{
    public function run()
    {
        $user = [
            [
                'id_status' => '1234567890',
                'name'      => 'IsUser',
                'username'  => 'IsUser',
                'email'     => 'user@gmail.com',
                'password'  => bcrypt('12345'),
                'roles_id'  => 6
            ],
            [
                'id_status' => '55201200401',
                'name'      => 'IsWalikelas',
                'username'  => 'IsWalikelas',
                'email'     => 'walikelas@gmail.com',
                'password'  => bcrypt('12345'),
                'roles_id'  => 5
            ],
            [
                'id_status' => '55201200402',
                'name'      => 'IsGuru',
                'username'  => 'IsGuru',
                'email'     => 'guru@gmail.com',
                'password'  => bcrypt('12345'),
                'roles_id'  => 4
            ],
            [
                'id_status' => '55201200403',
                'name'      => 'IsBendahara',
                'username'  => 'IsBendahara',
                'email'     => 'bendahara@gmail.com',
                'password'  => bcrypt('12345'),
                'roles_id'  => 3
            ],
            [
                'id_status' => '55201200404',
                'name'      => 'IsKepsek',
                'username'  => 'IsKepsek',
                'email'     => 'kepsek@gmail.com',
                'password'  => bcrypt('12345'),
                'roles_id'  => 2
            ],
            [
                'id_status' => '55201200405',
                'name'      => 'IsAdmin',
                'username'  => 'IsAdmin',
                'email'     => 'admin@gmail.com',
                'password'  => bcrypt('12345'),
                'roles_id'  => 1
            ]
        ];

        foreach ($user as $key => $value) {
            User::create($value);
        }
    }
}