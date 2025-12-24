<?php

namespace Database\Seeders;

use App\Models\AcademicLevel;
use Illuminate\Database\Seeder;

class AcademicLevelClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $academicLevels = AcademicLevel::all();

        foreach ($academicLevels as $academicLevel) {
            switch ($academicLevel->id) {
                case 1:
                    $academicLevel->classes()->attach([1, 2, 3, 4]);
                    break;
                case 2:
                    $academicLevel->classes()->attach([5, 6, 7, 8, 9]);
                    break;
                case 3:
                    $academicLevel->classes()->attach([10, 11, 12]);
                    break;
                case 4:
                    $academicLevel->classes()->attach([13, 14]);
                    break;
                case 5:
                    $academicLevel->classes()->attach([15, 16]);
                    break;

                default:
                    # code...
                    break;
            }
        }
    }
}
