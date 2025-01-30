<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Division;
use App\Models\City;

class DivisionCitySeeder extends Seeder
{
    public function run()
    {
        $data = [
            'Dhaka' => [
                'Dhaka City',
                'Narayanganj',
                'Tangail',
                'Madaripur',
                'Munshiganj',
                'Manikganj',
                'Shariatpur',
                'Narsingdi',
                'Faridpur',
                'Keraniganj',
                'Savar',
                'Gopalganj',
                'Gazipur',
                'Kishoreganj',
            ],
            'Khulna' => [
                'Khulna City',
                'Sonadanga',
                'Khalishpur',
                'Rupsha',
                'Mongla',
                'Kachua',
                'Rampal',
                'Morrelganj',
                'Fakirhat',
                'Chitalmari',
                'Mollahat',
                'Sharankhola',
                'Satkhira City',
                'Assasuni',
                'Kaliganj',
                'Keshabpur',
                'Chaugachha',
                'Jhikargacha',
                'Monirampur',
                'Abhaynagar',
            ],
            'Chattogram' => [
                'Chattogram City',
                'Fatikchhari',
                'Patiya',
                'Banshkhali',
                'Anwara',
                'Satkania',
                'Lohagara',
                'Mirsharai',
                'Rangunia',
                'Boalkhali',
                'Sandwip',
                "Cox's Bazar",
                'Ramu',
                'Maheshkhali',
                'Kutubdia',
                'Chakaria',
                'Ukhia',
                'Teknaf',
                'Pekua',
                'Noakhali',
                'Begumganj',
                'Senbagh',
                'Subarnachar',
                'Haimchar',
                'Laksam',
                'Comilla',
                'Brahmanbaria',
                'Chandpur',
                'Feni',
            ],
            'Rajshahi' => [
                'Rajshahi City',
                'Naogaon',
                'Natore',
                'Pabna',
                'Bogura',
                'Sherpur',
                'Sirajganj',
                'Meherpur',
                'Godagari',
                'Tarash',
                'Mohammadpur',
                'Vita',
                'Raninagar',
                'Bagha',
                'Tanore',
                'Kahaloo',
            ],
            'Barisal' => [
                'Barisal City',
                'Bhola',
                'Patuakhali',
                'Barguna',
                'Jhalkathi',
                'Pirojpur',
                'Kusumgram',
                'Ramnagar',
            ],
            'Sylhet' => [
                'Sylhet City',
                'Moulvibazar',
                'Habiganj',
                'Sunamganj',
            ],
            'Rangpur' => [
                'Rangpur City',
                'Kurigram',
                'Thakurgaon',
                'Dinajpur',
                'Gaibandha',
                'Nilphamari',
                'Lalmonirhat',
                'Panchagarh',
                'Chilmari',
            ],
            'Mymensingh' => [
                'Mymensingh City',
                'Bhaluka',
                'Muktagachha',
                'Gafargaon',
                'Fulbaria',
                'Nandail',
                'Trishal',
                'Mymensingh Sadar',
                'Netrokona',
                'Jamalpur',
            ]
        ];


        // Create Divisions and their Cities
        foreach ($data as $division => $cities) {
            $divisionRecord = Division::create(['name' => $division]);

            foreach ($cities as $city) {
                City::create([
                    'name' => $city,
                    'division_id' => $divisionRecord->id
                ]);
            }
        }
    }
}
