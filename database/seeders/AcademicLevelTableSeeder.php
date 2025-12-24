<?php

namespace Database\Seeders;

use App\Models\AcademicLevel;
use Illuminate\Database\Seeder;

class AcademicLevelTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AcademicLevel::insert([
            [
                'id' => 1,
                'slug' => 'pre-primary',
                'name_en' => 'Pre-Primary',
                'name_np' => 'पूर्व-प्राथमिक',
                'tagline_en' => 'Foundational learning and play-based activities.',
                'tagline_np' => 'आधारभूत सिकाइ र खेल–आधारित गतिविधिहरू।',
                'short_description_en' => '<p class="text-xs text-gray-600">
                            1:15 Student-Teacher Ratio
                        </p>
                        <p class="text-xs text-gray-500">
                            Focus: Play-Based Learning
                        </p>',
                'short_description_np' => '<p class="text-xs text-gray-600">
                            १:१५ विद्यार्थी–शिक्षक अनुपात
                        </p>
                        <p class="text-xs text-gray-500">
                            केन्द्रबिन्दु: खेल–आधारित सिकाइ
                        </p>',
                'display_order' => 1,
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'id' => 2,
                'slug' => 'primary-level',
                'name_en' => 'Primary Level',
                'name_np' => 'प्राथमिक स्तर',
                'tagline_en' => 'Core subjects and social development (Grades 1-5).',
                'tagline_np' => 'मूल विषयहरू र सामाजिक विकास (कक्षा १–५)।',
                'short_description_en' => '<p class="text-xs text-gray-600">
                            Focus on Literacy & Numeracy
                        </p>
                        <p class="text-xs text-gray-500">
                            Daily CCA: Arts & Sports
                        </p>',
                'short_description_np' => '<p class="text-xs text-gray-600">
                            साक्षरता र सङ्ख्याज्ञानमा ध्यान
                        </p>
                        <p class="text-xs text-gray-500">
                            दैनिक CCA: कला र खेलकुद
                        </p>',
                'display_order' => 2,
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'id' => 3,
                'slug' => 'lower-secondary',
                'name_en' => 'Lower Secondary',
                'name_np' => 'निम्न माध्यमिक स्तर',
                'tagline_en' => 'Transitional years focusing on advanced basics (Grades 6-8).',
                'tagline_np' => 'सांक्रमणिक वर्षहरू: उन्नत आधारभूत ज्ञानमा केन्द्रित (कक्षा ६–८)।',
                'short_description_en' => '<p class="text-xs text-gray-600">
                            Introduction to Laboratory Science
                        </p>
                        <p class="text-xs text-gray-500">
                            Focus: Subject Exploration
                        </p>',
                'short_description_np' => '<p class="text-xs text-gray-600">
                            प्रयोगशाला विज्ञान परिचय
                        </p>
                        <p class="text-xs text-gray-500">
                            केन्द्रित: विषय अन्वेषण
                        </p>',
                'display_order' => 3,
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'id' => 4,
                'slug' => 'secondary',
                'name_en' => 'Secondary',
                'name_np' => 'माध्यमिक स्तर',
                'tagline_en' => 'Board-exam preparation and subject depth (Grades 9-10).',
                'tagline_np' => 'बोर्ड परीक्षा तयारी र विषयगत गहिराइ (कक्षा ९–१०)।',
                'short_description_en' => '<p class="text-xs text-gray-600">
                            Proven Track Record in Board Exams
                        </p>
                        <p class="text-xs text-gray-500">
                            Focus: Examination Readiness
                        </p>',
                'short_description_np' => '<p class="text-xs text-gray-600">
                            बोर्ड परीक्षामा प्रमाणित सफलताको रेकर्ड
                        </p>
                        <p class="text-xs text-gray-500">
                            केन्द्रित: परीक्षा तयारी
                        </p>',
                'display_order' => 4,
                'is_featured' => true,
                'is_published' => true,
            ],
            [
                'id' => 5,
                'slug' => 'higher-secondary',
                'name_en' => 'Higher Secondary',
                'name_np' => 'उच्च माध्यमिक स्तर',
                'tagline_en' => 'Specialized streams for university readiness (Grades 11-12).',
                'tagline_np' => 'विश्वविद्यालय तयारीका लागि विशेषीकृत प्रवाहहरू (कक्षा ११–१२)।',
                'short_description_en' => '<p class="text-xs text-gray-600">
                            Career Counseling & University Placement
                        </p>
                        <p class="text-xs text-gray-500">
                            Focus: Specialization
                        </p>',
                'short_description_np' => '<p class="text-xs text-gray-600">
                            क्यारियर परामर्श र विश्वविद्यालयमा प्रवेश
                        </p>
                        <p class="text-xs text-gray-500">
                            केन्द्रित: विशेषीकरण
                        </p>',
                'display_order' => 5,
                'is_featured' => true,
                'is_published' => true,
            ],
        ]);
    }
}
