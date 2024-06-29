<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_categories')->insert([
            [
                'icon' => 'book-open', 
                'name' => 'Fiction',
                'description' => 'Explore a diverse range of fiction books, from contemporary novels to timeless classics, that captivate and entertain readers of all ages.'
            ],
            [
                'icon' => 'book-open', 
                'name' => 'Non-Fiction',
                'description' => 'Discover insightful and informative non-fiction books covering a wide array of topics including history, science, biographies, and self-help.'
            ],
            [
                'icon' => 'book-open', 
                'name' => 'Children’s Books',
                'description' => 'A delightful collection of children’s books that inspire and educate young readers with stories full of adventure, wonder, and life lessons.'
            ],
            [
                'icon' => 'book-open', 
                'name' => 'Fantasy & Science Fiction',
                'description' => 'Immerse yourself in fantastical worlds and futuristic adventures with our selection of fantasy and science fiction books.'
            ],
            [
                'icon' => 'book-open', 
                'name' => 'Mystery & Thriller',
                'description' => 'Dive into suspenseful and gripping stories that keep you on the edge of your seat with our mystery and thriller books.'
            ],
            [
                'icon' => 'book-open', 
                'name' => 'Romance',
                'description' => 'Indulge in heartwarming and passionate love stories with our wide range of romance novels.'
            ],
            [
                'icon' => 'book-open', 
                'name' => 'Self-Help & Personal Development',
                'description' => 'Enhance your life with our collection of self-help and personal development books that offer practical advice and motivational insights.'
            ],
        ]); 
    }
}
