<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $citiesByProvince = [
            // ======================
            // NCR (Metro Manila)
            // ======================
            "Metro Manila" => [
                "Caloocan",
                "Las Piñas",
                "Makati",
                "Malabon",
                "Mandaluyong",
                "Manila",
                "Marikina",
                "Muntinlupa",
                "Navotas",
                "Parañaque",
                "Pasay",
                "Pasig",
                "Quezon City",
                "San Juan",
                "Taguig",
                "Valenzuela",
            ],

            // ======================
            // CAR
            // ======================
            "Abra" => [],
            "Apayao" => [],
            "Benguet" => ["Baguio"],
            "Ifugao" => [],
            "Kalinga" => ["Tabuk"],
            "Mountain Province" => [],

            // ======================
            // Region I – Ilocos
            // ======================
            "Ilocos Norte" => ["Laoag"],
            "Ilocos Sur" => ["Candon", "Vigan"],
            "La Union" => ["San Fernando (La Union)"],
            "Pangasinan" => [
                "Alaminos",
                "Dagupan",
                "San Carlos (Pangasinan)",
                "Urdaneta",
            ],

            // ======================
            // Region II – Cagayan Valley
            // ======================
            "Batanes" => [],
            "Cagayan" => ["Tuguegarao"],
            "Isabela" => ["Cauayan", "Ilagan", "Santiago"],
            "Nueva Vizcaya" => [],
            "Quirino" => [],

            // ======================
            // Region III – Central Luzon
            // ======================
            "Aurora" => [],
            "Bataan" => ["Balanga"],
            "Bulacan" => ["Malolos", "Meycauayan", "San Jose del Monte"],
            "Nueva Ecija" => [
                "Cabanatuan",
                "Gapan",
                "Palayan",
                "San Jose (Nueva Ecija)",
            ],
            "Pampanga" => ["Angeles", "San Fernando (Pampanga)"],
            "Tarlac" => ["Tarlac City"],
            "Zambales" => ["Olongapo"],

            // ======================
            // Region IV-A – CALABARZON
            // ======================
            "Batangas" => ["Batangas City", "Lipa", "Tanauan"],
            "Cavite" => [
                "Bacoor",
                "Cavite City",
                "Dasmariñas",
                "General Trias",
                "Imus",
                "Tagaytay",
                "Trece Martires",
            ],
            "Laguna" => [
                "Biñan",
                "Cabuyao",
                "Calamba",
                "San Pablo",
                "Santa Rosa",
            ],
            "Quezon" => ["Lucena", "Tayabas"],
            "Rizal" => ["Antipolo"],

            // ======================
            // MIMAROPA
            // ======================
            "Marinduque" => [],
            "Occidental Mindoro" => [],
            "Oriental Mindoro" => ["Calapan"],
            "Palawan" => ["Puerto Princesa"],
            "Romblon" => [],

            // ======================
            // Region V – Bicol
            // ======================
            "Albay" => ["Legazpi", "Ligao", "Tabaco"],
            "Camarines Norte" => [],
            "Camarines Sur" => ["Iriga", "Naga"],
            "Catanduanes" => [],
            "Masbate" => ["Masbate City"],
            "Sorsogon" => ["Sorsogon City"],

            // ======================
            // Region VI – Western Visayas
            // ======================
            "Aklan" => [],
            "Antique" => [],
            "Capiz" => ["Roxas City"],
            "Guimaras" => [],
            "Iloilo" => ["Iloilo City", "Passi"],
            "Negros Occidental" => [
                "Bacolod",
                "Bago",
                "Cadiz",
                "Escalante",
                "Himamaylan",
                "Kabankalan",
                "La Carlota",
                "Sagay",
                "San Carlos (Negros Occidental)",
                "Silay",
                "Sipalay",
                "Talisay (Negros Occidental)",
                "Victorias",
            ],

            // ======================
            // Region VII – Central Visayas
            // ======================
            "Bohol" => ["Tagbilaran"],
            "Cebu" => [
                "Bogo",
                "Carcar",
                "Cebu City",
                "Danao",
                "Lapu-Lapu",
                "Mandaue",
                "Naga (Cebu)",
                "Talisay (Cebu)",
                "Toledo",
            ],
            "Negros Oriental" => [
                "Bais",
                "Bayawan",
                "Canlaon",
                "Dumaguete",
                "Guihulngan",
                "Tanjay",
            ],
            "Siquijor" => [],

            // ======================
            // Region VIII – Eastern Visayas
            // ======================
            "Biliran" => [],
            "Eastern Samar" => [],
            "Leyte" => ["Baybay", "Ormoc", "Tacloban"],
            "Northern Samar" => [],
            "Samar" => [],
            "Southern Leyte" => [],

            // ======================
            // Region IX – Zamboanga Peninsula
            // ======================
            "Zamboanga del Norte" => ["Dapitan", "Dipolog"],
            "Zamboanga del Sur" => ["Pagadian", "Zamboanga City"],
            "Zamboanga Sibugay" => [],

            // ======================
            // Region X – Northern Mindanao
            // ======================
            "Bukidnon" => ["Malaybalay", "Valencia"],
            "Camiguin" => [],
            "Lanao del Norte" => [],
            "Misamis Occidental" => ["Oroquieta", "Ozamiz", "Tangub"],
            "Misamis Oriental" => ["Cagayan de Oro", "El Salvador", "Gingoog"],

            // ======================
            // Region XI – Davao Region
            // ======================
            "Davao de Oro" => [],
            "Davao del Norte" => ["Panabo", "Samal", "Tagum"],
            "Davao del Sur" => ["Davao City", "Digos"],
            "Davao Occidental" => [],
            "Davao Oriental" => ["Mati"],

            // ======================
            // Region XII – SOCCSKSARGEN
            // ======================
            "Cotabato (North Cotabato)" => ["Kidapawan"],
            "Sarangani" => [],
            "South Cotabato" => ["General Santos", "Koronadal"],
            "Sultan Kudarat" => ["Tacurong"],

            // ======================
            // BARMM
            // ======================
            "Basilan" => ["Lamitan"],
            "Lanao del Sur" => ["Marawi"],
            "Maguindanao del Norte" => ["Cotabato City"],
            "Maguindanao del Sur" => [],
            "Sulu" => [],
            "Tawi-Tawi" => ["Bongao"],

            // ======================
            // Region XIII – Caraga
            // ======================
            "Agusan del Norte" => ["Butuan", "Cabadbaran"],
            "Agusan del Sur" => [],
            "Dinagat Islands" => [],
            "Surigao del Norte" => ["Surigao City"],
            "Surigao del Sur" => ["Bislig", "Tandag"],
        ];

        foreach ($citiesByProvince as $province => $cities) {
            foreach ($cities as $city) {
                \App\Models\City::create([
                    "name" => $city,
                    "province_code" => $province,
                    "code" => $city,
                ]);
            }
        }
    }
}
