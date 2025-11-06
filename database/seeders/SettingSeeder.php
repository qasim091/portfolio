<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'My Portfolio', 'type' => 'text'],
            ['key' => 'name', 'value' => 'Qasim Mehmood', 'type' => 'text'],
            ['key' => 'image', 'value' => '/img/qasim.jpg', 'type' => 'image'],
            ['key' => 'site_tagline', 'value' => 'Full Stack Developer', 'type' => 'text'],
            ['key' => 'contact_email', 'value' => 'Qasimmehmood1413@gmail.com', 'type' => 'email'],
            ['key' => 'whatsapp', 'value' => '0315-7750480', 'type' => 'phone'],
            ['key' => 'client', 'value' => '30', 'type' => 'number'],
            ['key' => 'project', 'value' => '50', 'type' => 'number'],
            ['key' => 'experience', 'value' => '5', 'type' => 'number'],
            ['key' => 'meta_description', 'value' => 'Crafting immersive digital experiences with cutting-edge web technologies, 3D graphics, and innovative solutions.', 'type' => 'text'],
            ['key' => 'about_desc', 'value' => 'I m a passionate full-stack developer with over 5 years of experience building innovative web applications and interactive experiences. My expertise spans across modern web technologies, 3D graphics, and user interface design. I specialize in creating performant, scalable applications using React, Laravel, Node.js, and Three.js. My work focuses on delivering exceptional user experiences through clean code and thoughtful design.', 'type' => 'text'],
            ['key' => 'github_url', 'value' => 'https://github.com/qasim091', 'type' => 'text'],
            ['key' => 'linkedin_url', 'value' => 'https://www.linkedin.com/in/qasimcoder/', 'type' => 'text'],
               // ✅ Correct JSON array for skills
    ['key' => 'skills', 'value' => json_encode([
        'React',
        'Laravel',
        'Vue.js',
        'Node.js',
        'Three.js',
        'TailwindCSS',
        'TypeScript',
        'PostgreSQL',
        'MongoDB',
        'AWS',
        'Docker',
        'Git',
    ]), 'type' => 'json'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
