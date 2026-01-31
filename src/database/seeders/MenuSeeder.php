<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;
use Carbon\Carbon;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        Menu::create([
            'name' => 'Nasi Goreng',
            'price' => 15000,
            'description' => 'Nasi goreng spesial dengan telur dan ayam.',
            'available_date' => Carbon::now(),
        ]);

        Menu::create([
            'name' => 'Mie Ayam',
            'price' => 12000,
            'description' => 'Mie ayam lezat dengan kuah segar.',
            'available_date' => Carbon::now(),
        ]);

        Menu::create([
            'name' => 'Es Teh Manis',
            'price' => 5000,
            'description' => 'Es teh manis dingin, pelepas dahaga.',
            'available_date' => Carbon::now(),
        ]);
    }
}
