<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Module;
use App\Models\Content;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CourseModuleContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // create 3 courses
        $courses = Course::factory(3)->create();

        foreach ($courses as $course) {
            // reate 2 modules for each course
            $modules = Module::factory(2)->create([
                'course_id' => $course->id
            ]);

            foreach ($modules as $module) {
                // create 3 contents for each module
                Content::factory(3)->create([
                    'module_id' => $module->id
                ]);
            }
        }
    }
}
