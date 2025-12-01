<?php

namespace Database\Seeders;

use App\Models\Province;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provincesByRegion = [
            // -------------------------
            // NCR
            // -------------------------
            "NCR" => ["Metro Manila"],

            // -------------------------
            // CAR
            // -------------------------
            "CAR" => [
                "Abra",
                "Apayao",
                "Benguet",
                "Ifugao",
                "Kalinga",
                "Mountain Province",
            ],

            // -------------------------
            // REGION I – Ilocos Region
            // -------------------------
            "Region I" => [
                "Ilocos Norte",
                "Ilocos Sur",
                "La Union",
                "Pangasinan",
            ],

            // -------------------------
            // REGION II – Cagayan Valley
            // -------------------------
            "Region II" => [
                "Batanes",
                "Cagayan",
                "Isabela",
                "Nueva Vizcaya",
                "Quirino",
            ],

            // -------------------------
            // REGION III – Central Luzon
            // -------------------------
            "Region III" => [
                "Aurora",
                "Bataan",
                "Bulacan",
                "Nueva Ecija",
                "Pampanga",
                "Tarlac",
                "Zambales",
            ],

            // -------------------------
            // REGION IV-A – CALABARZON
            // -------------------------
            "Region IV-A" => [
                "Batangas",
                "Cavite",
                "Laguna",
                "Quezon",
                "Rizal",
            ],

            // -------------------------
            // MIMAROPA
            // -------------------------
            "MIMAROPA" => [
                "Marinduque",
                "Occidental Mindoro",
                "Oriental Mindoro",
                "Palawan",
                "Romblon",
            ],

            // -------------------------
            // REGION V – Bicol Region
            // -------------------------
            "Region V" => [
                "Albay",
                "Camarines Norte",
                "Camarines Sur",
                "Catanduanes",
                "Masbate",
                "Sorsogon",
            ],

            // -------------------------
            // REGION VI – Western Visayas
            // -------------------------
            "Region VI" => [
                "Aklan",
                "Antique",
                "Capiz",
                "Guimaras",
                "Iloilo",
                "Negros Occidental",
            ],

            // -------------------------
            // REGION VII – Central Visayas
            // -------------------------
            "Region VII" => ["Bohol", "Cebu", "Negros Oriental", "Siquijor"],

            // -------------------------
            // REGION VIII – Eastern Visayas
            // -------------------------
            "Region VIII" => [
                "Biliran",
                "Eastern Samar",
                "Leyte",
                "Northern Samar",
                "Samar",
                "Southern Leyte",
            ],

            // -------------------------
            // REGION IX – Zamboanga Peninsula
            // -------------------------
            "Region IX" => [
                "Zamboanga del Norte",
                "Zamboanga del Sur",
                "Zamboanga Sibugay",
            ],

            // -------------------------
            // REGION X – Northern Mindanao
            // -------------------------
            "Region X" => [
                "Bukidnon",
                "Camiguin",
                "Lanao del Norte",
                "Misamis Occidental",
                "Misamis Oriental",
            ],

            // -------------------------
            // REGION XI – Davao Region
            // -------------------------
            "Region XI" => [
                "Davao de Oro",
                "Davao del Norte",
                "Davao del Sur",
                "Davao Occidental",
                "Davao Oriental",
            ],

            // -------------------------
            // REGION XII – SOCCSKSARGEN
            // -------------------------
            "Region XII" => [
                "Cotabato (North Cotabato)",
                "Sarangani",
                "South Cotabato",
                "Sultan Kudarat",
            ],

            // -------------------------
            // BARMM – Bangsamoro
            // -------------------------
            "BARMM" => [
                "Basilan",
                "Lanao del Sur",
                "Maguindanao del Norte",
                "Maguindanao del Sur",
                "Sulu",
                "Tawi-Tawi",
            ],

            // -------------------------
            // REGION XIII – Caraga Region
            // -------------------------
            "Region XIII" => [
                "Agusan del Norte",
                "Agusan del Sur",
                "Dinagat Islands",
                "Surigao del Norte",
                "Surigao del Sur",
            ],
        ];

        foreach ($provincesByRegion as $region => $provinces) {
            foreach ($provinces as $province) {
                Province::create([
                    "region_code" => $region,
                    "name" => $province,
                    "code" => $province,
                ]);
            }
        }
    }
}
