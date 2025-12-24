<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $models = [
            'user',
            'role',
            'permission',
            'setting',
            'slider',
            'menu',
            'page',
            'gallery',
            'department',
            'designation',
            'link',
            'contact us',
            'popup',
            'award & achivements',
            'careers',
            'job application',
            'download category',
            'download',
            'faq category',
            'faq',
            'service',
            'beyond academic',
            'academic level',
            'teams',
            'unique selling point',
            'publication category',
            'publication',
            'classes',
            'subject',
            'group',
            'faculty',
            'admission',
            'drawer navigation',
            'founder and principal',
            'volunteer form',
            'volunteer',
            'statistics',
            'about us',
            'testimonial',
            'alumni',
            'alumni form',
            'subscription',
        ];

        foreach ($models as $model) {
            Permission::firstOrCreate([
                'name' => $model,
                'guard_name' => 'web',
            ]);
        }
    }
}
