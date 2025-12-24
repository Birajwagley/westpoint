<?php

namespace Database\Seeders;

use App\Models\Group;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Group::insert([
            [
                'name' => 'Group 1',
                'display_order' => '1',
                'is_published' => true,
                'have_multi_subject' => false,
            ],
            [
                'name' => 'Group 2',
                'display_order' => '2',
                'is_published' => true,
                'have_multi_subject' => false,
            ],
            [
                'name' => 'Group 3',
                'display_order' => '3',
                'is_published' => true,
                'have_multi_subject' => false,
            ],
            [
                'name' => 'Group 4',
                'display_order' => '4',
                'is_published' => true,
                'have_multi_subject' => false,
            ],
            [
                'name' => 'Group 5',
                'display_order' => '5',
                'is_published' => true,
                'have_multi_subject' => false,
            ],
            [
                'name' => 'Group 6',
                'display_order' => '6',
                'is_published' => true,
                'have_multi_subject' => false,
            ],
        ]);
    }
}
