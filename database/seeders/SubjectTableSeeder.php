<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subject::insert([
            [
                'name_en' => 'English',
                'name_np' => 'अंग्रेजी',
                'display_order' => 1,
                'is_published' => true,
            ],
            [
                'name_en' => 'Nepali',
                'name_np' => 'नेपाली',
                'display_order' => 2,
                'is_published' => true,
            ],
            [
                'name_en' => 'Mathematics',
                'name_np' => 'गणित',
                'display_order' => 3,
                'is_published' => true,
            ],
            [
                'name_en' => 'Social Studies',
                'name_np' => 'सामाजिक अध्ययन',
                'display_order' => 4,
                'is_published' => true,
            ],
            [
                'name_en' => 'Physics',
                'name_np' => 'भौतिक',
                'display_order' => 5,
                'is_published' => true,
            ],
            [
                'name_en' => 'Accountancy',
                'name_np' => 'लेखाशास्त्र',
                'display_order' => 6,
                'is_published' => true,
            ],
            [
                'name_en' => 'Computer Science',
                'name_np' => 'कम्प्युटर विज्ञान',
                'display_order' => 7,
                'is_published' => true,
            ],
            [
                'name_en' => 'Hotel Management',
                'name_np' => 'होटल व्यवस्थापन',
                'display_order' => 8,
                'is_published' => true,
            ],
            [
                'name_en' => 'Business Studies',
                'name_np' => 'व्यवसाय अध्ययन',
                'display_order' => 9,
                'is_published' => true,
            ],
            [
                'name_en' => 'Biology',
                'name_np' => 'जीवविज्ञान',
                'display_order' => 10,
                'is_published' => true,
            ],
            [
                'name_en' => 'Economics',
                'name_np' => 'अर्थशास्त्र',
                'display_order' => 11,
                'is_published' => true,
            ],
            [
                'name_en' => 'Chemistry',
                'name_np' => 'रसायन',
                'display_order' => 12,
                'is_published' => true,
            ],
        ]);
    }
}
