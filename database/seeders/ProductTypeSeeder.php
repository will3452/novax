<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')
            ->insert([
                [
                    'name' => 'Hardcover',
                    'description' => 'Durable and long-lasting books with a sturdy cover, perfect for collectors and avid readers who value quality.',
                    'icon' => 'book-open'
                ],
                [
                    'name' => 'Paperback',
                    'description' => 'Lightweight and portable books with a flexible cover, ideal for everyday reading and convenient to carry around.',
                    'icon' => 'book-open'
                ],
                [
                    'name' => 'E-book',
                    'description' => 'Digital versions of books that can be read on electronic devices such as tablets, e-readers, and smartphones.',
                    'icon' => 'book-open'
                ],
                [
                    'name' => 'Audiobook',
                    'description' => 'Books in audio format, allowing readers to enjoy their favorite titles through listening, perfect for multitasking or on-the-go.',
                    'icon' => 'book-open'
                ],
                [
                    'name' => 'Graphic Novel',
                    'description' => 'Books that use sequential art to tell a story, combining visuals with text for a unique and immersive reading experience.',
                    'icon' => 'book-open'
                ],
                [
                    'name' => 'Magazine',
                    'description' => 'Periodicals with a wide range of topics including current events, fashion, technology, and more, available in both print and digital formats.',
                    'icon' => 'book-open'
                ],
            ]); 
    }
}
