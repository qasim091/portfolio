<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Web App',
                'slug' => 'web-app',
                'description' => 'Full-featured web applications built with modern frameworks',
                'order' => 1,
            ],
            [
                'name' => 'Mobile',
                'slug' => 'mobile',
                'description' => 'Native and cross-platform mobile applications',
                'order' => 2,
            ],
            [
                'name' => '3D',
                'slug' => '3d',
                'description' => '3D graphics, animations, and interactive experiences',
                'order' => 3,
            ],
            [
                'name' => 'Blockchain',
                'slug' => 'blockchain',
                'description' => 'Decentralized applications and blockchain solutions',
                'order' => 4,
            ],
            [
                'name' => 'AI/ML',
                'slug' => 'ai-ml',
                'description' => 'Artificial Intelligence and Machine Learning projects',
                'order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
