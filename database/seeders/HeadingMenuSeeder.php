<?php

namespace Database\Seeders;

use App\Models\HeadingMenu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeadingMenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Settings'
            ],
        ];

        HeadingMenu::insert($data);
    }
}
