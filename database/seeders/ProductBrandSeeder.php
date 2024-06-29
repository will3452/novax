<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_brands')
            ->insert([
                [
                    'name' => 'Literary Horizons',
                    'logo' => '',
                    'description' => 'Literary Horizons is renowned for its high-quality, award-winning fiction and non-fiction titles. From gripping novels to enlightening biographies, their books are crafted to captivate and inspire readers. Known for discovering new literary talent and publishing works that challenge and provoke thought, Literary Horizons is a favorite among avid readers and literary enthusiasts.'
                ],
                [
                    'name' => 'Epic Tales Publishing',
                    'logo' => '',
                    'description' => 'Epic Tales Publishing specializes in fantasy and science fiction genres, bringing to life imaginative worlds and epic adventures. Their catalog features bestselling series, standalone novels, and graphic novels that appeal to fans of all ages. With a commitment to excellent storytelling and stunning cover art, Epic Tales Publishing transports readers to realms of wonder and excitement.'
                ],
                [
                    'name' => 'Knowledge Quest Press',
                    'logo' => '',
                    'description' => 'Knowledge Quest Press is dedicated to providing readers with informative and engaging non-fiction books. Covering a wide range of topics from history and science to self-help and personal development, their publications aim to educate and empower. Known for their meticulously researched content and accessible writing style, Knowledge Quest Press is a trusted source for curious minds seeking to expand their knowledge.'
                ], 
            ]); 
    }
}
