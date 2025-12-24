<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Enum\MenuTypeEnum;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            // Top Level Menus
            ['id' => 1, 'name_en' => 'Home', 'name_np' => 'गृहपृष्ठ', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => null],
            ['id' => 2, 'name_en' => 'About Us', 'name_np' => 'हाम्रो बारेमा', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => null],
            ['id' => 3, 'name_en' => 'Beyond Academics', 'name_np' => 'अध्ययनभन्दा बाहिर', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => null],
            ['id' => 4, 'name_en' => 'Downloads', 'name_np' => 'डाउनलोड', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => null],
            ['id' => 5, 'name_en' => 'Academic Levels', 'name_np' => 'शैक्षिक कार्यक्रम', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => null],
            ['id' => 6, 'name_en' => 'Volunteer', 'name_np' => 'स्वयंसेवक', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => null],
            ['id' => 7, 'name_en' => 'Careers', 'name_np' => 'करियर', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => null],
            ['id' => 8, 'name_en' => 'Contact Us', 'name_np' => 'सम्पर्क गर्नुहोस्', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => null],
            ['id' => 9, 'name_en' => 'More', 'name_np' => 'थप', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => null],

            // Children of "About Us"
            ['name_en' => 'School Profile', 'name_np' => 'विद्यालय प्रोफाइल', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 2],
            ['name_en' => 'His Excellency Late Gyan Bahadur Yakthumba', 'name_np' => 'स्वर्गीय ज्ञानेन्द्र बहादुर याक्थुम्बा', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 2],
            ['name_en' => 'Founder Principal', 'name_np' => 'संस्थापक प्रधानाध्यापक', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 2],
            ['name_en' => 'Vice Principal', 'name_np' => 'उप प्रधानाध्यापक', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 2],
            ['name_en' => 'Executive Director', 'name_np' => 'कार्यकारी निर्देशक', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 2],
            ['name_en' => 'Learning Pedagogy', 'name_np' => 'शिक्षण प्रणाली', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 2],

            // Children of "Beyond Academics"
            ['name_en' => 'Facilities', 'name_np' => 'सुविधाहरू', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 3],
            ['name_en' => 'Club & ECA', 'name_np' => 'क्लब र ईसीए', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 3],
            ['name_en' => 'USP', 'name_np' => 'विशेषता', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 3],

            // Children of "More"
            ['name_en' => 'Quick Links', 'name_np' => 'महत्वपूर्ण लिंकहरू', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 9],
            ['name_en' => 'FAQs', 'name_np' => 'प्रश्नोत्तर', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 9],
            ['name_en' => 'Gallery', 'name_np' => 'ग्यालरी', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 9],
            ['name_en' => 'Teams', 'name_np' => 'टिम', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 9],
            ['name_en' => 'Publications', 'name_np' => 'प्रकाशनहरू', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 9],
            ['name_en' => 'Site Map', 'name_np' => 'साइट म्याप', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 9],
            ['name_en' => 'Privacy Statement', 'name_np' => 'गोपनीयता नीति', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 9],
            ['name_en' => 'Terms and Conditions', 'name_np' => 'नियम र सर्तहरू', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 9],
            ['name_en' => 'Alumni', 'name_np' => 'पूर्व विद्यार्थी', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 9],
            ['name_en' => 'Awards', 'name_np' => 'पुरस्कार', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 9],
            ['name_en' => 'Achievements', 'name_np' => 'उपलब्धिहरू', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 9],
            ['name_en' => 'Testimonials', 'name_np' => 'प्रशंसापत्र', 'type' => MenuTypeEnum::SLUG->value, 'external_link' => null, 'parent_id' => 9],
        ];

        foreach ($menus as $index => $menu) {
            if ($menu['name_en'] == 'Gallery') {
                $slug = 'galleries';
            } else {
                $slug = Str::slug($menu['name_en']);
            }

            Menu::create([
                'type' => $menu['type'],
                'slug' => $slug,
                'external_link' => $menu['external_link'],
                'parent_id' => $menu['parent_id'],
                'name_en' => $menu['name_en'],
                'name_np' => $menu['name_np'],
                'display_order' => $index + 1,
                'is_featured_navigation' => false,
                'icon' => null,
                'is_published' => true,
            ]);
        }
    }
}
