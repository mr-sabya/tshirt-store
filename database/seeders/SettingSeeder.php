<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Setting::create([
            'site_name' => 'Look4Up',
            'tagline' => 'Find Everything Here!',
            'logo' => 'site/logo.png',
            'footer_logo' => 'site/footer-logo.png',
            'favicon' => 'site/favicon.png',
            'currency' => 'BDT',
            'top_header_text' => 'Welcome to Look4Up!',
            'footer_about' => 'Look4Up is your ultimate destination for finding the best products and services.',
            'email' => 'info@look4up.com',
            'phone' => '+1234567890',
            'address' => '123, Look4Up Street, City, Country',
            'newsletter_text' => 'Subscribe to our newsletter for the latest updates.',
            'copyright_text' => '© 2025 Look4Up. All rights reserved.',
            'facebook' => 'https://facebook.com/look4up',
            'twitter' => 'https://twitter.com/look4up',
            'linkedin' => 'https://linkedin.com/company/look4up',
            'instagram' => 'https://instagram.com/look4up',
            'youtube' => 'https://youtube.com/look4up',
            'tiktok' => 'https://tiktok.com/@look4up',
            'thread' => 'https://threads.net/look4up',
            'meta_title' => 'Look4Up - Find Everything',
            'meta_description' => 'Look4Up is the best place to find products and services tailored for you.',
            'meta_keywords' => 'look4up, find, search, products, services',
        ]);
    }
}
