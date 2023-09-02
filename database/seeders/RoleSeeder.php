<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Admin',
                'slug' => \Str::slug('Admin')
            ],
            [
                'name' => 'Member',
                'slug' => \Str::slug('Member')
            ],
        ];

        Role::insert($data);
    }
}
