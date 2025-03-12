<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Page::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'sub_heading' => 'Learn more about our company',
        ]);

        Page::create([
            'title' => 'Contact Us',
            'slug' => 'contact-us',
            'sub_heading' => 'Get in touch with us!',
        ]);

        Page::create([
            'title' => 'FAQ',
            'slug' => 'faq',
            'sub_heading' => 'Frequently Asked Questions',
        ]);

        Page::create([
            'title' => 'Terms & Conditions',
            'slug' => 'terms-conditions',
            'sub_heading' => 'Our terms and conditions',
        ]);

        Page::create([
            'title' => 'Privacy Policy',
            'slug' => 'privacy-policy',
            'sub_heading' => 'Our privacy policy',
        ]);

        Page::create([
            'title' => 'Refund Policy',
            'slug' => 'refund-policy',
            'sub_heading' => 'Our refund policy',
        ]);

        Page::create([
            'title' => 'Retun Policy',
            'slug' => 'return-policy',
            'sub_heading' => 'Our return policy',
        ]);

        Page::create([
            'title' => 'Delivery Information',
            'slug' => 'delivery-information',
            'sub_heading' => 'Our delivery information',
        ]);


    }
}
