<?php

namespace Database\Seeders;

use App\Models\Classes;
use Illuminate\Database\Seeder;

class ClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classes::insert([
            [
                'id' => 1,
                'name_en' => 'Play Group (PG)',
                'name_np' => 'प्ले ग्रुप',
                'display_order' => 1,
                'is_published' => true,
                'is_admission_allowed' => true,
            ],
            [
                'id' => 2,
                'name_en' => 'Nursery',
                'name_np' => 'नरसरी',
                'display_order' => 2,
                'is_published' => true,
                'is_admission_allowed' => true,
            ],
            [
                'id' => 3,
                'name_en' => 'L.K.G',
                'name_np' => 'एल.के.जी',
                'display_order' => 3,
                'is_published' => true,
                'is_admission_allowed' => true,
            ],
            [
                'id' => 4,
                'name_en' => 'U.K.G',
                'name_np' => 'यु.के.जी',
                'display_order' => 4,
                'is_published' => true,
                'is_admission_allowed' => true,
            ],
            [
                'id' => 5,
                'name_en' => 'Grade 1',
                'name_np' => 'कक्षा १',
                'display_order' => 5,
                'is_published' => true,
                'is_admission_allowed' => true,
            ],
            [
                'id' => 6,
                'name_en' => 'Grade 2',
                'name_np' => 'कक्षा २',
                'display_order' => 6,
                'is_published' => true,
                'is_admission_allowed' => true,
            ],

            [
                'id' => 7,
                'name_en' => 'Grade 3',
                'name_np' => 'कक्षा ३',
                'display_order' => 7,
                'is_published' => true,
                'is_admission_allowed' => true,
            ],
            [
                'id' => 8,
                'name_en' => 'Grade 4',
                'name_np' => 'कक्षा ४',
                'display_order' => 8,
                'is_published' => true,
                'is_admission_allowed' => true,
            ],
            [
                'id' => 9,
                'name_en' => 'Grade 5',
                'name_np' => 'कक्षा ५',
                'display_order' => 9,
                'is_published' => true,
                'is_admission_allowed' => true,
            ],
            [
                'id' => 10,
                'name_en' => 'Grade 6',
                'name_np' => 'कक्षा ६',
                'display_order' => 10,
                'is_published' => true,
                'is_admission_allowed' => true,
            ],
            [
                'id' => 11,
                'name_en' => 'Grade 7',
                'name_np' => 'कक्षा ७',
                'display_order' => 11,
                'is_published' => true,
                'is_admission_allowed' => true,
            ],
            [
                'id' => 12,
                'name_en' => 'Grade 8',
                'name_np' => 'कक्षा ८',
                'display_order' => 12,
                'is_published' => true,
                'is_admission_allowed' => true,
            ],
            [
                'id' => 13,
                'name_en' => 'Grade 9',
                'name_np' => 'कक्षा ९',
                'display_order' => 13,
                'is_published' => true,
                'is_admission_allowed' => true,
            ],
            [
                'id' => 14,
                'name_en' => 'Grade 10',
                'name_np' => 'कक्षा १०',
                'display_order' => 14,
                'is_published' => true,
                'is_admission_allowed' => false,
            ],
            [
                'id' => 15,
                'name_en' => 'Grade 11',
                'name_np' => 'कक्षा ११',
                'display_order' => 15,
                'is_published' => true,
                'is_admission_allowed' => true,
            ],
            [
                'id' => 16,
                'name_en' => 'Grade 12',
                'name_np' => 'कक्षा १२',
                'display_order' => 16,
                'is_published' => true,
                'is_admission_allowed' => true,
            ],
        ]);
    }
}
