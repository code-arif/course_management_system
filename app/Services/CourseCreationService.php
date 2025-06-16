<?php
// app/Services/CourseCreationService.php

namespace App\Services;

use App\Models\Course;
use App\Models\Module;
use App\Models\Content;
use Illuminate\Support\Facades\DB;

class CourseCreationService
{
    public function createCourse(array $validatedData)
    {
        return DB::transaction(function () use ($validatedData) {
            // Create Course
            $course = Course::create([
                'title' => $validatedData['title'],
                'description' => $validatedData['description'] ?? null,
                'category' => $validatedData['category'],
                'price' => $validatedData['price'] ?? null,
                'duration' => $validatedData['duration'] ?? null,
                'thumbnail' => $validatedData['thumbnail'] ?? null,
                'status' => $validatedData['status'],
                'instructor_name' => $validatedData['instructor_name'] ?? null,
                'published_at' => $validatedData['published_at'] ?? null,
            ]);

            $this->createModules($course, $validatedData['modules']);

            return $course->load('modules.contents');
        });
    }

    protected function createModules(Course $course, array $modules)
    {
        foreach ($modules as $moduleData) {
            $module = $course->modules()->create([
                'title' => $moduleData['title'],
                'summary' => $moduleData['summary'] ?? null,
                'duration' => $moduleData['duration'] ?? null,
                'status' => $moduleData['status'] ?? 'draft',
            ]);

            if (!empty($moduleData['contents'])) {
                $this->createContents($module, $moduleData['contents']);
            }
        }
    }

    protected function createContents(Module $module, array $contents)
    {
        $contentsToCreate = array_map(function ($content) {
            return [
                'type' => $content['type'],
                'title' => $content['title'],
                'data' => $content['data'] ?? null,
                'duration' => $content['duration'] ?? null,
            ];
        }, $contents);

        $module->contents()->createMany($contentsToCreate);
    }
}
