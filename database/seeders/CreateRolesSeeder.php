<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;

class CreateRolesSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'Admin',

            ],
            [
                'id' => 2,
                'name' => 'Kepala Sekolah',
            ],
            [
                'id' => 3,
                'name' => 'Bendahara',
            ],
            [
                'id' => 4,
                'name' => 'Guru',
            ],
            [
                'id' => 5,
                'name' => 'Walikelas',
            ],
            [
                'id' => 6,
                'name' => 'Siswa',
            ],
        ];

        foreach ($roles as $key => $role) {
            Roles::create($role);
        }
    }
}