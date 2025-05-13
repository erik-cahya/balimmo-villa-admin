<?php

namespace Database\Seeders;

use App\Models\FeatureListModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $dataFeature = [
                [
                    'name' => 'Fully Furnished',
                    'slug' => 'fully-furnished',
                    'type' => 'indoor',
                ],
                [
                    'name' => 'Equipped Kitchen',
                    'slug' => 'equipped-kitchen',
                    'type' => 'indoor',

                ],
                [
                    'name' => 'Air Conditioning in All Room',
                    'slug' => 'air-conditioning',
                    'type' => 'indoor',

                ],
                [
                    'name' => 'Dressing Room or Built-in Wardobes',
                    'slug' => 'dressing-room-built-wardobe',
                    'type' => 'indoor',
                ],
                [
                    'name' => 'Bathub in Master Bedroom',
                    'slug' => 'bathub-master-bedroom',
                    'type' => 'indoor',
                ],
                [
                    'name' => 'Laundry Room with Washing Machince',
                    'slug' => 'laundry-room',
                    'type' => 'indoor',
                ],
                [
                    'name' => 'Home Cinema or Projector',
                    'slug' => 'home-cinema',
                    'type' => 'indoor',
                ],
                [
                    'name' => 'Office Spaces',
                    'slug' => 'office-spaces',
                    'type' => 'indoor',
                ],
                [
                    'name' => 'Installed Wi-Fi',
                    'slug' => 'installed-wifi',
                    'type' => 'indoor',
                ],
                [
                    'name' => 'Equipped Kitchen',
                    'slug' => 'equipped-kitchen',
                    'type' => 'indoor',
                ],
                [
                    'name' => 'Safe Box',
                    'slug' => 'safe-box',
                    'type' => 'outdoor',
                ],
                [
                    'name' => 'Smart Home System',
                    'slug' => 'smart-home-system',
                    'type' => 'indoor',
                ],
                [
                    'name' => 'Integrated Audio System',
                    'slug' => 'integrated-audio-system',
                    'type' => 'indoor',
                ],
                [
                    'name' => 'CCTY System',
                    'slug' => 'cctv-system',
                    'type' => 'indoor',
                ],
                [
                    'name' => 'Infinity Pool',
                    'slug' => 'infinity-pool',
                    'type' => 'outdoor',
                ],
                [
                    'name' => 'Pool Deck / Sun Loungers Included',
                    'slug' => 'pool-deck-sun-loungers',
                    'type' => 'outdoor',
                ],
                [
                    'name' => 'Landscape Garden',
                    'slug' => 'landscape-garden',
                    'type' => 'outdoor',
                ],
                [
                    'name' => 'Gazebo / Outdoor Lounges',
                    'slug' => 'gazebo-outdoor-lounges',
                    'type' => 'outdoor',
                ],
                [
                    'name' => 'Outdoor Shower',
                    'slug' => 'outdoor-shower',
                    'type' => 'outdoor',
                ],
                [
                    'name' => 'Outdoor Kitchen or Barbeque Area',
                    'slug' => 'outdoor-kitchen-barbeque-area',
                    'type' => 'outdoor',
                ],
                [
                    'name' => 'Garage / Carport',
                    'slug' => 'garage-carport',
                    'type' => 'outdoor',
                ],
                [
                    'name' => 'Automatic Gate',
                    'slug' => 'automatic-gate',
                    'type' => 'outdoor',
                ],
                [
                    'name' => 'Ocean View',
                    'slug' => 'ocean-view',
                    'type' => 'outdoor',
                ],
                [
                    'name' => 'Rice Field View',
                    'slug' => 'rice-field-view',
                    'type' => 'outdoor',
                ],
                [
                    'name' => 'Jungle View',
                    'slug' => 'jungle-view',
                    'type' => 'outdoor',
                ],
                [
                    'name' => 'West Facing (Sunset View)',
                    'slug' => 'west-facing',
                    'type' => 'outdoor',
                ],
                [
                    'name' => 'Direct Beach Access',
                    'slug' => 'direct-beach-access',
                    'type' => 'outdoor',
                ],
                [
                    'name' => 'Rooftop Terrace',
                    'slug' => 'rooftop-terrace',
                    'type' => 'outdoor',
                ],
        ];

        foreach($dataFeature as $row){
            FeatureListModel::create($row);
        }


    }
}
