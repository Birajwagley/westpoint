<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PermissionTableSeeder::class,
            RoleTableSeeder::class,
            UserTableSeeder::class,
            SettingTableSeeder::class,
            SubjectTableSeeder::class,
            GroupTableSeeder::class,
            MessageFromTableSeeder::class,
            ClassesTableSeeder::class,
            AcademicLevelTableSeeder::class,
            AcademicLevelClassTableSeeder::class,
            PublicationCategoryTableSeeder::class,
            AboutUsTableSeeder::class,
            DepartmentTableSeeder::class,
            DesignationTableSeeder::class,
            MenuTableSeeder::class,
            AlumniTableSeeder::class,
            VolunteerTableSeeder::class,
            PageTableSeeder::class,
        ]);
    }
}
