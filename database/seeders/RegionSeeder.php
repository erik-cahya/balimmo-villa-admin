<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            "badung" => [
                "Kuta",
                "Seminyak",
                "Canggu",
                "Jimbaran",
                "Nusa Dua",
                "Pecatu",
                "Uluwatu"
            ],
            "gianyar" => [
                "Ubud",
                "Tegallalang",
                "Sukawati",
                "Tampaksiring",
                "Payangan",
                "Blahbatuh"
            ],
            "tabanan" => [
                "Bedugul",
                "Penebel",
                "Kerambitan",
                "Baturiti",
                "Selemadeg",
                "Marga"
            ],
            "denpasar" => [
                "Denpasar Barat",
                "Denpasar Timur",
                "Denpasar Selatan",
                "Denpasar Utara"
            ],
            "karangasem" => [
                "Amlapura",
                "Candidasa",
                "Tirta Gangga",
                "Sidemen",
                "Abang",
                "Kubu"
            ],
            "bangli" => [
                "Kintamani",
                "Bangli",
                "Susut",
                "Tembuku"
            ],
            "klungkung" => [
                "Semarapura",
                "Nusa Penida",
                "Nusa Lembongan",
                "Banjarangkan",
                "Dawan"
            ],
            "buleleng" => [
                "Singaraja",
                "Lovina",
                "Seririt",
                "Tejakula",
                "Banjar"
            ],
            "jembrana" => [
                "Negara",
                "Pekutatan",
                "Mendoyo",
                "Melaya"
            ]
        ];

        foreach ($regions as $region => $subRegions) {
            $regionId = DB::table('regions')->insertGetId([
                'name' => ucfirst($region),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($subRegions as $subRegion) {
                DB::table('sub_regions')->insert([
                    'region_id' => $regionId,
                    'name' => $subRegion,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}
