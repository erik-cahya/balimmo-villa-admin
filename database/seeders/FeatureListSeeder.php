<?php

namespace Database\Seeders;

use App\Models\FeatureListModel;
use App\Models\User;
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
                    'type' => 'Indoor',
                ],
                [
                    'name' => 'Equipped Kitchen',
                    'slug' => 'equipped-kitchen',
                    'type' => 'Indoor',

                ],
                [
                    'name' => 'Air Conditioning in All Room',
                    'slug' => 'air-conditioning',
                    'type' => 'Indoor',

                ],
                [
                    'name' => 'Dressing Room or Built-in Wardobes',
                    'slug' => 'dressing-room-built-wardobe',
                    'type' => 'Indoor',
                ],
                [
                    'name' => 'Bathub in Master Bedroom',
                    'slug' => 'bathub-master-bedroom',
                    'type' => 'Indoor',
                ],
                [
                    'name' => 'Laundry Room with Washing Machince',
                    'slug' => 'laundry-room',
                    'type' => 'Indoor',
                ],
                [
                    'name' => 'Home Cinema or Projector',
                    'slug' => 'home-cinema',
                    'type' => 'Indoor',
                ],
                [
                    'name' => 'Office Spaces',
                    'slug' => 'office-spaces',
                    'type' => 'Indoor',
                ],
                [
                    'name' => 'Installed Wi-Fi',
                    'slug' => 'installed-wifi',
                    'type' => 'Indoor',
                ],
                [
                    'name' => 'Safe Box',
                    'slug' => 'safe-box',
                    'type' => 'Outdoor',
                ],
                [
                    'name' => 'Smart Home System',
                    'slug' => 'smart-home-system',
                    'type' => 'Indoor',
                ],
                [
                    'name' => 'Integrated Audio System',
                    'slug' => 'integrated-audio-system',
                    'type' => 'Indoor',
                ],
                [
                    'name' => 'CCTY System',
                    'slug' => 'cctv-system',
                    'type' => 'Indoor',
                ],
                [
                    'name' => 'Infinity Pool',
                    'slug' => 'infinity-pool',
                    'type' => 'Outdoor',
                ],
                [
                    'name' => 'Pool Deck / Sun Loungers Included',
                    'slug' => 'pool-deck-sun-loungers',
                    'type' => 'Outdoor',
                ],
                [
                    'name' => 'Landscape Garden',
                    'slug' => 'landscape-garden',
                    'type' => 'Outdoor',
                ],
                [
                    'name' => 'Gazebo / Outdoor Lounges',
                    'slug' => 'gazebo-outdoor-lounges',
                    'type' => 'Outdoor',
                ],
                [
                    'name' => 'Outdoor Shower',
                    'slug' => 'outdoor-shower',
                    'type' => 'Outdoor',
                ],
                [
                    'name' => 'Outdoor Kitchen or Barbeque Area',
                    'slug' => 'outdoor-kitchen-barbeque-area',
                    'type' => 'Outdoor',
                ],
                [
                    'name' => 'Garage / Carport',
                    'slug' => 'garage-carport',
                    'type' => 'Outdoor',
                ],
                [
                    'name' => 'Automatic Gate',
                    'slug' => 'automatic-gate',
                    'type' => 'Outdoor',
                ],
                [
                    'name' => 'Ocean View',
                    'slug' => 'ocean-view',
                    'type' => 'Outdoor',
                ],
                [
                    'name' => 'Rice Field View',
                    'slug' => 'rice-field-view',
                    'type' => 'Outdoor',
                ],
                [
                    'name' => 'Jungle View',
                    'slug' => 'jungle-view',
                    'type' => 'Outdoor',
                ],
                [
                    'name' => 'West Facing (Sunset View)',
                    'slug' => 'west-facing',
                    'type' => 'Outdoor',
                ],
                [
                    'name' => 'Direct Beach Access',
                    'slug' => 'direct-beach-access',
                    'type' => 'Outdoor',
                ],
                [
                    'name' => 'Rooftop Terrace',
                    'slug' => 'rooftop-terrace',
                    'type' => 'Outdoor',
                ],
        ];

        foreach($dataFeature as $row){
            FeatureListModel::create($row);
        }

        User::create([
            'name' => 'Erik Cahya Pradana',
            'email' => 'erikcp38@gmail.com',
            'phone_number' => "089522648527",
            'password' => bcrypt('howtoplay123'),
            'reference_code' => 'BPM-ERIK-3213',
            'role' => 'master',
        ]);


    }
}
