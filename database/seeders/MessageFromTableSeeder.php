<?php

namespace Database\Seeders;

use App\Models\MessageFrom;
use Illuminate\Database\Seeder;
use App\Enum\MessageFromTypeEnum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MessageFromTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MessageFrom::insert([
            [
                'id' => 1,
                'slug' => MessageFromTypeEnum::INDIRAYAKTHUMBA->value,
                'information_en' => json_encode([
                    'name' => 'Indira Yakthumba',
                ]),
            ],
            [
                'id' => 2,
                'slug' => MessageFromTypeEnum::GYANBAHADURYAKTHUMBA->value,
                'information_en' => json_encode([
                    'name' => 'Gyan Bahadur Yakthumba',
                ]),
            ],
        ]);
    }
}
