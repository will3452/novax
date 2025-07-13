<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Guide;
use App\Models\Tag;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class GuideSeeder extends Seeder
{
    public function fake() {
        return Faker::create();
    }
    public function run(): void
    {
        // Create static tags if none exist
        if (Tag::count() === 0) {
            $tagNames = ['Laravel', 'PHP', 'VueJS', 'Nuxt', 'Docker', 'API', 'Testing', 'DevOps', 'Database', 'Backend'];
            foreach ($tagNames as $name) {
                Tag::create([
                    'name' => $name
                ]);
            }
        }

        $tags = Tag::all();



        // Create 20 guides
        for ($i = 0; $i < 20; $i++) {

            $title = $this->fake()->sentence(6);
            $slug = Str::slug($title) . '-' . $i;

            $guide = Guide::create([
                'author_user_id' => 1, // Always user ID 1
                'title' => $title,
                'slug' => $slug,
                'cover_image' => $this->fake()->imageUrl(800, 600, 'guides', true),
                'content' => $this->fake()->paragraphs(5, true),
                'version' => '1.0',
                'status' => 'published',
                'published_at' => now(),
                'organization_id' => 1, // Always organization ID 1
                'helpful_count' => $this->fake()->numberBetween(0, 100),
                'category' => ['QA', 'DEV', 'ONBOARDING'][$this->fake()->numberBetween(0, 2)],
            ]);

            // Attach random tags
            $guide->tags()->attach($tags->random(rand(1, 5))->pluck('id'));

            // Create initial version
            $guide->versions()->create([
                'version' => '1.0',
                'content' => $guide->content,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
