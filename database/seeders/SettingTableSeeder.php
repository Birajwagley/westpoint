<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'id' => 1,
            'title_en' => 'Gyanodaya Bal Batika School',
            'address_en' => 'Bungamati/ Khokana, Lalitpur, Nepal',
            'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d56555.88601255481!2d85.300212!3d27.632479!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb17bda336085f%3A0x1eaa680e8a6e89f!2sGyanodaya%20Bal%20Batika%20School!5e0!3m2!1sen!2sus!4v1755426645043!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
            'facebook' => 'https://www.facebook.com/Gyanodaya/',
            'instagram' => 'https://www.instagram.com/gyanodayabalbatika/',
            'x' => 'https://twitter.com/gyanodayaschool',
            'youtube' => 'https://www.youtube.com/channel/UClOL43jqZs-JQP3lpm9KDaw?view_as=subscriber',
        ]);
    }
}
