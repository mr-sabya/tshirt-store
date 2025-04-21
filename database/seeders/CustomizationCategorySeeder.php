<?php

namespace Database\Seeders;

use App\Models\CustomizationCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomizationCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CustomizationCategory::create([
            'name' => 'tshirt',
            'image' => 'categories/tshirt.png',
            'positions' => ['front_side', 'back_side', 'left_sleeve', 'right_sleeve'],
            'prices' => [
                'front_side' => 5.00,
                'back_side' => 4.00,
                'left_sleeve' => 3.00,
                'right_sleeve' => 3.00,
            ],
        ]);

        CustomizationCategory::create([
            'name' => 'mug',
            'image' => 'categories/mug.png',
            'positions' => ['left_side', 'right_side', 'full_design'],
            'prices' => [
                'left_side' => 2.50,
                'right_side' => 2.50,
                'full_design' => 5.00,
            ],
        ]);

        CustomizationCategory::create([
            'name' => 'cap',
            'image' => 'categories/cap.png',
            'positions' => ['front', 'back', 'side'],
            'prices' => [
                'front' => 3.50,
                'back' => 2.00,
                'side' => 2.50,
            ],
        ]);
    }
}
