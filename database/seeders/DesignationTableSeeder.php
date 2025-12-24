<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Designation;

class DesignationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $designations = [
            ['name_en' => 'Founder / Chairman', 'name_np' => 'संस्थापक / अध्यक्ष'],
            ['name_en' => 'Principal', 'name_np' => 'प्रधानाध्यापक'],
            ['name_en' => 'Vice Principal / Academic Coordinator', 'name_np' => 'उप-प्रधानाध्यापक / शैक्षिक संयोजक'],
            ['name_en' => 'Executive Director', 'name_np' => 'कार्यकारी निर्देशक'],
            ['name_en' => 'School Administrator', 'name_np' => 'विद्यालय प्रशासक'],
            ['name_en' => 'Section Head', 'name_np' => 'सेक्शन प्रमुख'],
            ['name_en' => 'Academic Coordinator', 'name_np' => 'शैक्षिक संयोजक'],
            ['name_en' => 'Examination Head / Controller of Examinations', 'name_np' => 'परीक्षा प्रमुख / परीक्षा नियन्त्रणकर्ता'],
            ['name_en' => 'Discipline In-charge', 'name_np' => 'अनुशासन इन्चार्ज'],
            ['name_en' => 'Co-Curricular Activities (CCA) Coordinator', 'name_np' => 'सह-पाठ्यक्रम क्रियाकलाप संयोजक'],
            ['name_en' => 'ECA (Extra-Curricular Activities) Coordinator', 'name_np' => 'अतिरिक्त क्रियाकलाप संयोजक'],
            ['name_en' => 'Career Guidance Counselor', 'name_np' => 'व्यवसायिक मार्गदर्शन परामर्शदाता'],
            ['name_en' => 'School Counselor / Psychologist', 'name_np' => 'विद्यालय परामर्शदाता / मनोवैज्ञानिक'],
            ['name_en' => 'Laboratory Assistant (Science / Computer Labs)', 'name_np' => 'प्रयोगशाला सहयोगी (विज्ञान / कम्प्युटर प्रयोगशाला)'],
            ['name_en' => 'Librarian', 'name_np' => 'पुस्तकालयाध्यक्ष'],
            ['name_en' => 'Office Secretary', 'name_np' => 'कार्यालय सचिव'],
            ['name_en' => 'Receptionist', 'name_np' => 'रिसेप्सनिष्ट'],
            ['name_en' => 'Admission Officer', 'name_np' => 'भर्ना अधिकारी'],
            ['name_en' => 'HR Officer', 'name_np' => 'मानव संसाधन अधिकारी'],
            ['name_en' => 'Finance Officer / Accountant', 'name_np' => 'वित्त अधिकारी / लेखापाल'],
            ['name_en' => 'Administrative Assistant', 'name_np' => 'प्रशासनिक सहायक'],
            ['name_en' => 'IT Support / System Administrator', 'name_np' => 'आइटी सहयोग / प्रणाली प्रशासक'],
            ['name_en' => 'Data Entry Operator', 'name_np' => 'डेटा प्रविष्टि अपरेटर'],
            ['name_en' => 'Transport In-Charge / Bus Coordinator', 'name_np' => 'यातायात इन्चार्ज / बस संयोजक'],
            ['name_en' => 'Drivers', 'name_np' => 'सवारी चालक'],
            ['name_en' => 'Logisticians', 'name_np' => 'लजिस्टिक कर्मचारी'],
            ['name_en' => 'Maintenance Staff', 'name_np' => 'मर्मत कर्मचारी'],
            ['name_en' => 'Cleaners / Janitors', 'name_np' => 'सफाइ कर्मचारी'],
            ['name_en' => 'Security Guards', 'name_np' => 'सुरक्षा गार्ड'],
            ['name_en' => 'School Nurse / Health Officer', 'name_np' => 'विद्यालय नर्स / स्वास्थ्य अधिकारी'],
            ['name_en' => 'Science and Tech Club Captain', 'name_np' => 'विज्ञान तथा प्रविधि क्लब कप्तान'],
            ['name_en' => 'Science and Tech Club Vice Captain', 'name_np' => 'विज्ञान तथा प्रविधि क्लब उप-कप्तान'],
            ['name_en' => 'Sports Club Captain', 'name_np' => 'खेलकुद क्लब कप्तान'],
            ['name_en' => 'Sports Club Vice Captain', 'name_np' => 'खेलकुद क्लब उप-कप्तान'],
            ['name_en' => 'Members', 'name_np' => 'सदस्य'],
            ['name_en' => 'Class Prefects', 'name_np' => 'कक्षा प्रिफेक्ट'],
        ];

        foreach ($designations as $index => $designation) {
            Designation::create([
                'name_en' => $designation['name_en'],
                'name_np' => $designation['name_np'],
                'display_order' => $index + 1,
                'is_published' => true,
            ]);
        }
    }
}
