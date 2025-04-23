<?php

namespace Database\Seeders;

use App\Models\VillaModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VillaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataVilla = [
                [
                    "villa_name" => "Villa Sunset Paradise",
                    "price" => 1500000,
                    "bedroom" => 2,
                    "sub_region" => "Seminyak"
                ],
                [
                    "villa_name" => "Villa Ocean Breeze",
                    "price" => 2300000,
                    "bedroom" => 3,
                    "sub_region" => "Canggu"
                ],
                [
                    "villa_name" => "Villa Jungle Retreat",
                    "price" => 1800000,
                    "bedroom" => 2,
                    "sub_region" => "Ubud"
                ],
                [
                    "villa_name" => "Villa Serene View",
                    "price" => 2100000,
                    "bedroom" => 3,
                    "sub_region" => "Sanur"
                ],
                [
                    "villa_name" => "Villa Azure Sky",
                    "price" => 2700000,
                    "bedroom" => 4,
                    "sub_region" => "Jimbaran"
                ],
                [
                    "villa_name" => "Villa Harmony Bliss",
                    "price" => 1600000,
                    "bedroom" => 2,
                    "sub_region" => "Legian"
                ],
                [
                    "villa_name" => "Villa Infinity Pool",
                    "price" => 3200000,
                    "bedroom" => 5,
                    "sub_region" => "Uluwatu"
                ],
                [
                    "villa_name" => "Villa Bamboo Breeze",
                    "price" => 1400000,
                    "bedroom" => 1,
                    "sub_region" => "Canggu"
                ],
                [
                    "villa_name" => "Villa Garden Soul",
                    "price" => 1900000,
                    "bedroom" => 2,
                    "sub_region" => "Ubud"
                ],
                [
                    "villa_name" => "Villa Blue Horizon",
                    "price" => 2500000,
                    "bedroom" => 3,
                    "sub_region" => "Seminyak"
                ],
                [
                    "villa_name" => "Villa Coconut Dreams",
                    "price" => 1700000,
                    "bedroom" => 2,
                    "sub_region" => "Sanur"
                ],
                [
                    "villa_name" => "Villa Serayu River",
                    "price" => 2200000,
                    "bedroom" => 3,
                    "sub_region" => "Ubud"
                ],
                [
                    "villa_name" => "Villa Morning Dew",
                    "price" => 1450000,
                    "bedroom" => 1,
                    "sub_region" => "Canggu"
                ],
                [
                    "villa_name" => "Villa Lotus Serenity",
                    "price" => 1600000,
                    "bedroom" => 2,
                    "sub_region" => "Kerobokan"
                ],
                [
                    "villa_name" => "Villa The White Sand",
                    "price" => 2900000,
                    "bedroom" => 4,
                    "sub_region" => "Nusa Dua"
                ],
                [
                    "villa_name" => "Villa Palm Garden",
                    "price" => 1800000,
                    "bedroom" => 2,
                    "sub_region" => "Legian"
                ],
                [
                    "villa_name" => "Villa Hidden Cliff",
                    "price" => 3100000,
                    "bedroom" => 4,
                    "sub_region" => "Uluwatu"
                ],
                [
                    "villa_name" => "Villa Ricefield Charm",
                    "price" => 1750000,
                    "bedroom" => 2,
                    "sub_region" => "Ubud"
                ],
                [
                    "villa_name" => "Villa Breeze Hill",
                    "price" => 2400000,
                    "bedroom" => 3,
                    "sub_region" => "Jimbaran"
                ],
                [
                    "villa_name" => "Villa Mango Tree",
                    "price" => 1500000,
                    "bedroom" => 1,
                    "sub_region" => "Sanur"
                ],
                [
                    "villa_name" => "Villa Sunset Bliss",
                    "price" => 2650000,
                    "bedroom" => 3,
                    "sub_region" => "Seminyak"
                ],
                [
                    "villa_name" => "Villa Ocean Pearl",
                    "price" => 2800000,
                    "bedroom" => 4,
                    "sub_region" => "Canggu"
                ],
                [
                    "villa_name" => "Villa Forest Essence",
                    "price" => 1900000,
                    "bedroom" => 2,
                    "sub_region" => "Ubud"
                ],
                [
                    "villa_name" => "Villa Cliffside Escape",
                    "price" => 3300000,
                    "bedroom" => 5,
                    "sub_region" => "Uluwatu"
                ],
                [
                    "villa_name" => "Villa Calm Breeze",
                    "price" => 1650000,
                    "bedroom" => 2,
                    "sub_region" => "Kerobokan"
                ],
                [
                    "villa_name" => "Villa Sunrise Lagoon",
                    "price" => 2000000,
                    "bedroom" => 3,
                    "sub_region" => "Sanur"
                ],
                [
                    "villa_name" => "Villa Lavender Dream",
                    "price" => 1550000,
                    "bedroom" => 2,
                    "sub_region" => "Legian"
                ],
                [
                    "villa_name" => "Villa Moonlight Bay",
                    "price" => 3000000,
                    "bedroom" => 4,
                    "sub_region" => "Nusa Dua"
                ],
                [
                    "villa_name" => "Villa Bamboo Whisper",
                    "price" => 1400000,
                    "bedroom" => 1,
                    "sub_region" => "Ubud"
                ],
                [
                    "villa_name" => "Villa Tropical Escape",
                    "price" => 1950000,
                    "bedroom" => 2,
                    "sub_region" => "Canggu"
                ],
                [
                    'villa_name' => 'Villa Sand Dunes',
                    'price' => 1850000,
                    'bedroom' => 2,
                    'sub_region' => 'Seminyak'
                ],
                [
                    'villa_name' => 'Villa Ocean Mist',
                    'price' => 2200000,
                    'bedroom' => 3,
                    'sub_region' => 'Canggu'
                ],
                [
                    'villa_name' => 'Villa River Breeze',
                    'price' => 1700000,
                    'bedroom' => 2,
                    'sub_region' => 'Ubud'
                ],
                [
                    'villa_name' => 'Villa Cliff Haven',
                    'price' => 3500000,
                    'bedroom' => 5,
                    'sub_region' => 'Uluwatu'
                ],
                [
                    'villa_name' => 'Villa Orchid Retreat',
                    'price' => 1600000,
                    'bedroom' => 2,
                    'sub_region' => 'Kerobokan'
                ],
                [
                    'villa_name' => 'Villa Sea Whisper',
                    'price' => 2500000,
                    'bedroom' => 3,
                    'sub_region' => 'Jimbaran'
                ],
                [
                    'villa_name' => 'Villa Hidden Bamboo',
                    'price' => 1400000,
                    'bedroom' => 1,
                    'sub_region' => 'Sanur'
                ],
                [
                    'villa_name' => 'Villa Starry Nights',
                    'price' => 2750000,
                    'bedroom' => 4,
                    'sub_region' => 'Nusa Dua'
                ],
                [
                    'villa_name' => 'Villa Tranquil Waters',
                    'price' => 1800000,
                    'bedroom' => 2,
                    'sub_region' => 'Ubud'
                ],
                [
                    'villa_name' => 'Villa Summer Light',
                    'price' => 2300000,
                    'bedroom' => 3,
                    'sub_region' => 'Legian'
                ],
                [
                    'villa_name' => 'Villa Dewi Serenity',
                    'price' => 1950000,
                    'bedroom' => 2,
                    'sub_region' => 'Seminyak'
                ],
                [
                    'villa_name' => 'Villa Infinity Jungle',
                    'price' => 2600000,
                    'bedroom' => 3,
                    'sub_region' => 'Ubud'
                ],
                [
                    'villa_name' => 'Villa Emerald View',
                    'price' => 2900000,
                    'bedroom' => 4,
                    'sub_region' => 'Canggu'
                ],
                [
                    'villa_name' => 'Villa Lotus Breeze',
                    'price' => 1500000,
                    'bedroom' => 1,
                    'sub_region' => 'Sanur'
                ],
                [
                    'villa_name' => 'Villa Volcano View',
                    'price' => 3200000,
                    'bedroom' => 5,
                    'sub_region' => 'Kintamani'
                ],
                [
                    'villa_name' => 'Villa Sunset Vibes',
                    'price' => 2100000,
                    'bedroom' => 3,
                    'sub_region' => 'Legian'
                ],
                [
                    'villa_name' => 'Villa Tegal View',
                    'price' => 1650000,
                    'bedroom' => 2,
                    'sub_region' => 'Tegallalang'
                ],
                [
                    'villa_name' => 'Villa Blue Lagoon',
                    'price' => 2450000,
                    'bedroom' => 3,
                    'sub_region' => 'Jimbaran'
                ],
                [
                    'villa_name' => 'Villa Stone Garden',
                    'price' => 1550000,
                    'bedroom' => 1,
                    'sub_region' => 'Kerobokan'
                ],
                [
                    'villa_name' => 'Villa Dreamland Escape',
                    'price' => 3000000,
                    'bedroom' => 4,
                    'sub_region' => 'Uluwatu'
                ]
            ];

            foreach ($dataVilla as $row) {
                VillaModel::create($row);
            }
    }
}
