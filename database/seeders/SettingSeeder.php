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
            ['key' => 'resume_pdf', 'value' => '/storage/settings/resume_pdf.pdf', 'type' => 'file'],
            ['key' => 'meta_description', 'value' => 'Crafting immersive digital experiences with cutting-edge web technologies, 3D graphics, and innovative solutions.', 'type' => 'text'],
            ['key' => 'about_desc', 'value' => 'I m a passionate full-stack developer with over 5 years of experience building innovative web applications and interactive experiences. My expertise spans across modern web technologies, 3D graphics, and user interface design. I specialize in creating performant, scalable applications using React, Laravel, Node.js, and Three.js. My work focuses on delivering exceptional user experiences through clean code and thoughtful design.', 'type' => 'text'],
            ['key' => 'github_url', 'value' => 'https://github.com/qasim091', 'type' => 'text'],
            ['key' => 'linkedin_url', 'value' => 'https://www.linkedin.com/in/qasimcoder/', 'type' => 'text'],
            ['key' => 'skills', 'value' => json_encode([
                ['name' => 'Frontend Development', 'percentage' => 95, 'icon' => 'code-2'],
                ['name' => 'Backend Development', 'percentage' => 90, 'icon' => 'server'],
                ['name' => 'Laravel & PHP', 'percentage' => 92, 'icon' => 'database'],
                ['name' => 'React & Vue.js', 'percentage' => 88, 'icon' => 'layout'],
                ['name' => 'UI/UX Design', 'percentage' => 85, 'icon' => 'palette'],
                ['name' => 'Database Management', 'percentage' => 87, 'icon' => 'hard-drive'],
                ['name' => 'API Development', 'percentage' => 93, 'icon' => 'git-branch'],
                ['name' => 'DevOps & Deployment', 'percentage' => 80, 'icon' => 'cloud'],
            ]), 'type' => 'json'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
