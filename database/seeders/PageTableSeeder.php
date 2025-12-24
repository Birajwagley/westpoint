<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Page::create([
            'title_en' => 'Academics',
            'title_en' => 'शैक्षिक कार्यक्रम',
            'short_description_en' => 'A Journey of Comprehensive Academic Growth',
            'short_description_np' => 'समग्र शैक्षिक विकासको यात्रा',
            'description_en' => '<p class="text-base sm:text-lg text-gray-600 leading-relaxed">
                    At our institution, academics are built on a foundation of holistic development. We believe that true
                    education extends beyond textbooks, integrating critical thinking and real-world application from the
                    very first year (Pre-Primary) through the university preparatory stages (Higher Secondary).

                    Our dedicated faculty is committed to creating a vibrant, supportive, and challenging learning
                    environment. We
                    use student-centric methodologies and modern pedagogy to ensure that every child is not just ready for
                    the
                    next grade, but ready for life.
                </p>


                <ul class="space-y-3 mt-4 sm:mt-6"><li class="flex items-start gap-3">
                        <span class="text-primary text-lg flex-shrink-0 pt-0.5">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <span class="text-gray-700">
                            We seamlessly blend national and international standards to provide a comprehensive, globally
                            relevant
                            knowledge base for all students.
                        </span>
                    </li><li class="flex items-start gap-3">
                        <span class="text-primary text-lg flex-shrink-0 pt-0.5">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <span class="text-gray-700">
                            We encourage students to ask why and how, fostering independent research and problem-solving
                            skills
                            essential for future success.
                        </span>
                    </li><li class="flex items-start gap-3">
                        <span class="text-primary text-lg flex-shrink-0 pt-0.5">
                            <i class="fa-solid fa-check"></i>
                        </span>
                        <span class="text-gray-700">
                            Low student-to-teacher ratios ensure individualized support, helping each learner unlock their
                            unique
                            strengths and capabilities.
                        </span>
                    </li></ul><p><br></p>',
        ]);
    }
}
