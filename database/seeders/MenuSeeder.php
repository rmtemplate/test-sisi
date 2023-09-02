<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id_role' => 1,
                'id_heading_menu' => 1,
                'name' => 'Manage Menu',
                'slug' => \Str::slug('Manage Menu'),
                'icon' => 'fas fa-gear',
                'url' => \Str::slug('Manage Menu'),
            ]
        ];

        Menu::insert($data);
    }
}
