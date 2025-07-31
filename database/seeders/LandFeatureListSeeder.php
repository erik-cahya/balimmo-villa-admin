<?php

namespace Database\Seeders;

use App\Models\Land\LandFeatureListModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LandFeatureListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dataFeature = [
            [
                'name' => 'Ocean View',
                'slug' => 'ocean-view',
                'type' => 'land-feature',
            ],
            [
                'name' => 'Rice Field View',
                'slug' => 'rice-field-view',
                'type' => 'land-feature',
            ],
            [
                'name' => 'Jungle View',
                'slug' => 'jungle-view',
                'type' => 'land-feature',
            ],
            [
                'name' => 'West Facing (Sunset View)',
                'slug' => 'west-facing',
                'type' => 'land-feature',
            ],

        ];

        foreach ($dataFeature as $row) {
            LandFeatureListModel::create($row);
        }
    }
}
