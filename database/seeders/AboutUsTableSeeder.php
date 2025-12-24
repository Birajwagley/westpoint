<?php

namespace Database\Seeders;

use App\Models\AboutUs;
use Illuminate\Database\Seeder;

class AboutUsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AboutUs::create([
            'title_en' => 'Our Education System Inspires You More',
            'title_np' => 'हाम्रो शिक्षण प्रणालीले तपाईंलाई अझ बढी प्रेरित गर्छ।',
        ]);
    }
}
