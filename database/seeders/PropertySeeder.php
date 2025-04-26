<?php

namespace Database\Seeders;

use App\Models\PropertiesModel;
use App\Models\PropertyModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataVilla = [
                [
                    "property_name" => "Villa Sunset Paradise",
                    "property_type" => 'villa',
                    "price" => 1500000,
                    "region" => "Seminyak"
                ],
                [
                    "property_name" => "Villa Ocean Breeze",
                    "property_type" => 'villa',
                    "price" => 2300000,
                    "region" => "Canggu"
                ],
                [
                    "property_name" => "Villa Jungle Retreat",
                    "property_type" => 'villa',
                    "price" => 1800000,
                    "region" => "Ubud"
                ],
                [
                    "property_name" => "Villa Serene View",
                    "property_type" => 'villa',
                    "price" => 2100000,
                    "region" => "Sanur"
                ],
                [
                    "property_name" => "Villa Azure Sky",
                    "property_type" => 'villa',
                    "price" => 2700000,
                    "region" => "Jimbaran"
                ],
                [
                    "property_name" => "Villa Harmony Bliss",
                    "property_type" => 'villa',
                    "price" => 1600000,
                    "region" => "Legian"
                ],
                [
                    "property_name" => "Villa Infinity Pool",
                    "property_type" => 'villa',
                    "price" => 3200000,
                    "region" => "Uluwatu"
                ],
                [
                    "property_name" => "Villa Bamboo Breeze",
                    "property_type" => 'villa',
                    "price" => 1400000,
                    "region" => "Canggu"
                ],
                [
                    "property_name" => "Villa Garden Soul",
                    "property_type" => 'villa',
                    "price" => 1900000,
                    "region" => "Ubud"
                ],
                [
                    "property_name" => "Villa Blue Horizon",
                    "property_type" => 'villa',
                    "price" => 2500000,
                    "region" => "Seminyak"
                ],
                [
                    "property_name" => "Villa Coconut Dreams",
                    "property_type" => 'villa',
                    "price" => 1700000,
                    "region" => "Sanur"
                ],
                [
                    "property_name" => "Villa Serayu River",
                    "property_type" => 'villa',
                    "price" => 2200000,
                    "region" => "Ubud"
                ],
                [
                    "property_name" => "Villa Morning Dew",
                    "property_type" => 'villa',
                    "price" => 1450000,
                    "region" => "Canggu"
                ],
                [
                    "property_name" => "Villa Lotus Serenity",
                    "property_type" => 'villa',
                    "price" => 1600000,
                    "region" => "Kerobokan"
                ],
                [
                    "property_name" => "Villa The White Sand",
                    "property_type" => 'villa',
                    "price" => 2900000,
                    "region" => "Nusa Dua"
                ],
                [
                    "property_name" => "Villa Palm Garden",
                    "property_type" => 'villa',
                    "price" => 1800000,
                    "region" => "Legian"
                ],
                [
                    "property_name" => "Villa Hidden Cliff",
                    "property_type" => 'villa',
                    "price" => 3100000,
                    "region" => "Uluwatu"
                ],
                [
                    "property_name" => "Villa Ricefield Charm",
                    "property_type" => 'villa',
                    "price" => 1750000,
                    "region" => "Ubud"
                ],
                [
                    "property_name" => "Villa Breeze Hill",
                    "property_type" => 'villa',
                    "price" => 2400000,
                    "region" => "Jimbaran"
                ],
                [
                    "property_name" => "Villa Mango Tree",
                    "property_type" => 'villa',
                    "price" => 1500000,
                    "region" => "Sanur"
                ],
                [
                    "property_name" => "Villa Sunset Bliss",
                    "property_type" => 'villa',
                    "price" => 2650000,
                    "region" => "Seminyak"
                ],
                [
                    "property_name" => "Villa Ocean Pearl",
                    "property_type" => 'villa',
                    "price" => 2800000,
                    "region" => "Canggu"
                ],
                [
                    "property_name" => "Villa Forest Essence",
                    "property_type" => 'villa',
                    "price" => 1900000,
                    "region" => "Ubud"
                ],
                [
                    "property_name" => "Villa Cliffside Escape",
                    "property_type" => 'villa',
                    "price" => 3300000,
                    "region" => "Uluwatu"
                ],
                [
                    "property_name" => "Villa Calm Breeze",
                    "property_type" => 'villa',
                    "price" => 1650000,
                    "region" => "Kerobokan"
                ],
                [
                    "property_name" => "Villa Sunrise Lagoon",
                    "property_type" => 'villa',
                    "price" => 2000000,
                    "region" => "Sanur"
                ],
                [
                    "property_name" => "Villa Lavender Dream",
                    "property_type" => 'villa',
                    "price" => 1550000,
                    "region" => "Legian"
                ],
                [
                    "property_name" => "Villa Moonlight Bay",
                    "property_type" => 'villa',
                    "price" => 3000000,
                    "region" => "Nusa Dua"
                ],
                [
                    "property_name" => "Villa Bamboo Whisper",
                    "property_type" => 'villa',
                    "price" => 1400000,
                    "region" => "Ubud"
                ],
                [
                    "property_name" => "Villa Tropical Escape",
                    "property_type" => 'villa',
                    "price" => 1950000,
                    "region" => "Canggu"
                ],
                [
                    'property_name' => 'Villa Sand Dunes',
                    "property_type" => 'villa',
                    'price' => 1850000,
                    'region' => 'Seminyak'
                ],
                [
                    'property_name' => 'Villa Ocean Mist',
                    "property_type" => 'villa',
                    'price' => 2200000,
                    'region' => 'Canggu'
                ],
                [
                    'property_name' => 'Villa River Breeze',
                    "property_type" => 'villa',
                    'price' => 1700000,
                    'region' => 'Ubud'
                ],
                [
                    'property_name' => 'Villa Cliff Haven',
                    "property_type" => 'villa',
                    'price' => 3500000,
                    'region' => 'Uluwatu'
                ],
                [
                    'property_name' => 'Villa Orchid Retreat',
                    "property_type" => 'villa',
                    'price' => 1600000,
                    'region' => 'Kerobokan'
                ],
                [
                    'property_name' => 'Villa Sea Whisper',
                    "property_type" => 'villa',
                    'price' => 2500000,
                    'region' => 'Jimbaran'
                ],
                [
                    'property_name' => 'Villa Hidden Bamboo',
                    "property_type" => 'villa',
                    'price' => 1400000,
                    'region' => 'Sanur'
                ],
                [
                    'property_name' => 'Villa Starry Nights',
                    "property_type" => 'villa',
                    'price' => 2750000,
                    'region' => 'Nusa Dua'
                ],
                [
                    'property_name' => 'Villa Tranquil Waters',
                    "property_type" => 'villa',
                    'price' => 1800000,
                    'region' => 'Ubud'
                ],
                [
                    'property_name' => 'Villa Summer Light',
                    "property_type" => 'villa',
                    'price' => 2300000,
                    'region' => 'Legian'
                ],
                [
                    'property_name' => 'Villa Dewi Serenity',
                    "property_type" => 'villa',
                    'price' => 1950000,
                    'region' => 'Seminyak'
                ],
                [
                    'property_name' => 'Villa Infinity Jungle',
                    "property_type" => 'villa',
                    'price' => 2600000,
                    'region' => 'Ubud'
                ],
                [
                    'property_name' => 'Villa Emerald View',
                    "property_type" => 'villa',
                    'price' => 2900000,
                    'region' => 'Canggu'
                ],
                [
                    'property_name' => 'Villa Lotus Breeze',
                    "property_type" => 'villa',
                    'price' => 1500000,
                    'region' => 'Sanur'
                ],
                [
                    'property_name' => 'Villa Volcano View',
                    "property_type" => 'villa',
                    'price' => 3200000,
                    'region' => 'Kintamani'
                ],
                [
                    'property_name' => 'Villa Sunset Vibes',
                    "property_type" => 'villa',
                    'price' => 2100000,
                    'region' => 'Legian'
                ],
                [
                    'property_name' => 'Villa Tegal View',
                    "property_type" => 'villa',
                    'price' => 1650000,
                    'region' => 'Tegallalang'
                ],
                [
                    'property_name' => 'Villa Blue Lagoon',
                    "property_type" => 'villa',
                    'price' => 2450000,
                    'region' => 'Jimbaran'
                ],
                [
                    'property_name' => 'Villa Stone Garden',
                    "property_type" => 'villa',
                    'price' => 1550000,
                    'region' => 'Kerobokan'
                ],
                [
                    'property_name' => 'Villa Dreamland Escape',
                    "property_type" => 'villa',
                    'price' => 3000000,
                    'region' => 'Uluwatu'
                ]
            ];

            foreach ($dataVilla as $row) {
                PropertiesModel::create($row);
            }
    }
}
