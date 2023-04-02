<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $courses =  ['cs101', 'cs201', 'mgt101', 'cs601', 'cs302'];

        foreach ($courses as $course) {
            $existingCourse = Course::where('name', $course)->first();
            if ($existingCourse) {
                $existingCourse->name = $course;
                $existingCourse->save();
            } else {
                $newCourse = new Course;
                $newCourse->name = $course;
                $newCourse->collage_id = 1;
                $newCourse->save();
            }
        }
    }
}
