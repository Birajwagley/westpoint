<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departments = [
            ['name_en' => 'Executive Director', 'name_np' => 'प्रबन्ध निर्देशक'],
            ['name_en' => 'Pre-Primary Department', 'name_np' => 'पूर्व-प्राथमिक विभाग'],
            ['name_en' => 'Primary Department', 'name_np' => 'प्राथमिक विभाग'],
            ['name_en' => 'Lower Secondary Department', 'name_np' => 'निम्न माध्यमिक विभाग'],
            ['name_en' => 'Secondary Department', 'name_np' => 'माध्यमिक विभाग'],
            ['name_en' => 'Higher Secondary Department', 'name_np' => 'उच्च माध्यमिक विभाग'],
            ['name_en' => 'English Department', 'name_np' => 'अङ्ग्रेजी विभाग'],
            ['name_en' => 'Nepali Department', 'name_np' => 'नेपाली विभाग'],
            ['name_en' => 'Mathematics Department', 'name_np' => 'गणित विभाग'],
            ['name_en' => 'Science Department', 'name_np' => 'विज्ञान विभाग'],
            ['name_en' => 'Social Studies Department', 'name_np' => 'सामाजिक अध्ययन विभाग'],
            ['name_en' => 'Computer Science / ICT Department', 'name_np' => 'कम्प्युटर विज्ञान / सूचना प्रविधि विभाग'],
            ['name_en' => 'Health, Physical Education & Sports Department', 'name_np' => 'स्वास्थ्य, शारीरिक शिक्षा र खेलकुद विभाग'],
            ['name_en' => 'Moral / Value Education Department', 'name_np' => 'नैतिक / मूल्य शिक्षा विभाग'],
            ['name_en' => 'Arts & Craft Department', 'name_np' => 'कला र हस्तकला विभाग'],
            ['name_en' => 'Music Department', 'name_np' => 'संगीत विभाग'],
            ['name_en' => 'Dance & Performing Arts Department', 'name_np' => 'नृत्य तथा प्रदर्शन कला विभाग'],
            ['name_en' => 'Accountancy, Economics & Business Studies Department', 'name_np' => 'लेखा, अर्थशास्त्र र व्यवसाय अध्ययन विभाग'],
            ['name_en' => 'Hotel Management Department', 'name_np' => 'होटल व्यवस्थापन विभाग'],
            ['name_en' => 'School Administration Department', 'name_np' => 'विद्यालय प्रशासन विभाग'],
            ['name_en' => 'Finance & Accounts Department', 'name_np' => 'वित्त र लेखा विभाग'],
            ['name_en' => 'Human Resource (HR) Department', 'name_np' => 'मानव संसाधन विभाग'],
            ['name_en' => 'Examination & Evaluation Department', 'name_np' => 'परीक्षा तथा मूल्यांकन विभाग'],
            ['name_en' => 'Library Department', 'name_np' => 'पुस्तकालय विभाग'],
            ['name_en' => 'Transportation Department', 'name_np' => 'यातायात विभाग'],
            ['name_en' => 'Admission & Public Relations Department', 'name_np' => 'भर्ना तथा जनसम्पर्क विभाग'],
            ['name_en' => 'IT & Technical Support Department', 'name_np' => 'सूचना प्रविधि तथा प्राविधिक सहयोग विभाग'],
            ['name_en' => 'Procurement / Store Department', 'name_np' => 'खरिद / भण्डार विभाग'],
            ['name_en' => 'Maintenance & Infrastructure Department', 'name_np' => 'मर्मत तथा पूर्वाधार विभाग'],
            ['name_en' => 'Health & First Aid Department', 'name_np' => 'स्वास्थ्य तथा प्रारम्भिक उपचार विभाग'],
            ['name_en' => 'Security Department', 'name_np' => 'सुरक्षा विभाग'],
            ['name_en' => 'Discipline & Student Affairs Department', 'name_np' => 'अनुशासन तथा विद्यार्थी मामिला विभाग'],
            ['name_en' => 'Counseling & Career Guidance Department', 'name_np' => 'परामर्श तथा करियर मार्गदर्शन विभाग'],
            ['name_en' => 'Extracurricular & Co-Curricular Activities Department', 'name_np' => 'अतिरिक्त तथा सह-पाठ्यक्रम क्रियाकलाप विभाग'],
            ['name_en' => 'House System / Student Leadership Department', 'name_np' => 'हाउस प्रणाली / विद्यार्थी नेतृत्व विभाग'],
            ['name_en' => 'Event & Cultural Coordination Department', 'name_np' => 'कार्यक्रम तथा सांस्कृतिक संयोजन विभाग'],
        ];

        foreach ($departments as $index => $department) {
            Department::create([
                'name_en' => $department['name_en'],
                'name_np' => $department['name_np'],
                'display_order' => $index + 1,
                'is_published' => true,
            ]);
        }
    }
}
