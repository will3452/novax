<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StoreCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('store_categories')->insert([
            [
                'name' => 'Books',
                'description' => 'A store that offers a wide variety of books, ranging from fiction and non-fiction to children’s books and academic texts.',
                'icon' => 'book-open'
            ],
            [
                'name' => 'Electronics',
                'description' => 'A retail outlet that specializes in selling electronic goods, including gadgets, appliances, and accessories.',
                'icon' => 'device-phone-mobile'
            ],
            [
                'name' => 'Fashion',
                'description' => 'A store offering a curated selection of stylish clothing, footwear, and accessories for men and women.',
                'icon' => 'sparkles'
            ], 
        ]); 
    }
}
