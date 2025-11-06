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
            ['key' => 'contact_address', 'value' => 'Abbottabad, Pakistan', 'type' => 'text'],
            ['key' => 'github_url', 'value' => 'https://github.com/qasim091', 'type' => 'text'],
            ['key' => 'linkedin_url', 'value' => 'https://www.linkedin.com/in/qasimcoder/', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            Setting::create($setting);
        }
    }
}
