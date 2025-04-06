<?php

namespace Database\Seeders;

use App\Models\Promotion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Promotion::create([
            'product_name' => 'Sample Product',
            'offer_text' => 'Special Offer Text',
            'offer_image' => 'path_to_offer_image.jpg',
            'offer_description' => 'This is a description of the special offer.',
            'product_id' => 1,  // Assuming you have a product with ID 1
            'background_image' => 'path_to_background_image.jpg',
        ]);
    }
}
