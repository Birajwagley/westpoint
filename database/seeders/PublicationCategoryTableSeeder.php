<?php

namespace Database\Seeders;

use App\Models\PublicationCategory;
use Illuminate\Database\Seeder;

class PublicationCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PublicationCategory::insert([
            [
                'id' => 1,
                'name_en' => 'Upcoming events',
                'name_np' => 'आगामी कार्यक्रमहरू',
                'display_order' => 1,
                'is_published' => true,
                'is_featured' => true,
            ],
            [
                'id' => 2,
                'name_en' => 'Important Notices',
                'name_np' => 'महत्वपूर्ण सूचनाहरू',
                'display_order' => 2,
                'is_published' => true,
                'is_featured' => true,
            ],
        ]);
    }
}
