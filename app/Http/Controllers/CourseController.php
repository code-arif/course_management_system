<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Course;
use App\Models\Module;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    //get all courses
    public function index()
    {
        $courses = Course::latest()->get();
        return view('pages.courses', compact('courses'));
    }

    //show course details
    public function show($id)
    {
        $course = Course::with(['modules.contents'])->findOrFail($id);

        return view('pages.course_details', compact('course'));
    }

    //create courses
    public function create()
    {
        return view('pages.course_create');
    }

    //store courses
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:2000',
            'category' => 'required|string|max:100',
            'price' => 'nullable|numeric|min:0|max:999999.99',
            'duration' => 'nullable|string|max:100',
            'thumbnail' => 'nullable|url|max:255',
            'status' => 'required|in:draft,published,archived',
            'instructor_name' => 'nullable|string|max:250',
            'published_at' => 'nullable|date',

            // Nested module validation (optional, can be done in loop below as well)
            'modules' => 'required|array',
            'modules.*.title' => 'required|string|max:255',
            'modules.*.summary' => 'nullable|string',
            'modules.*.duration' => 'nullable|string|max:100',
            'modules.*.status' => 'nullable|in:draft,published',

            'modules.*.contents' => 'nullable|array',
            'modules.*.contents.*.type' => 'required|in:text,image,video,link,pdf,quiz',
            'modules.*.contents.*.title' => 'required|string|max:255',
            'modules.*.contents.*.value' => 'nullable|string',
            'modules.*.contents.*.duration' => 'nullable|string|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => false,
                    'errors' => $validator->errors(),
                ],
                422,
            );
        }

        DB::beginTransaction();

        try {
            $validated = $validator->validated();

            //step 1: create the course
            $course = Course::create([
                'title' => $validated['title'],
                'description' => $validated['description'] ?? null,
                'category' => $validated['category'],
                'price' => $validated['price'] ?? null,
                'duration' => $validated['duration'] ?? null,
                'thumbnail' => $validated['thumbnail'] ?? null,
                'status' => $validated['status'],
                'instructor_name' => $validated['instructor_name'] ?? null,
                'published_at' => $validated['published_at'] ?? null,
            ]);

            // step 2: create modules
            foreach ($validated['modules'] as $moduleData) {
                $module = new Module([
                    'title' => $moduleData['title'],
                    'summary' => $moduleData['summary'] ?? null,
                    'duration' => $moduleData['duration'] ?? null,
                    'status' => $moduleData['status'] ?? 'draft',
                ]);

                $course->modules()->save($module);

                // step 3: ceate contents (if any)
                if (!empty($moduleData['contents'])) {
                    foreach ($moduleData['contents'] as $contentData) {
                        $content = new Content([
                            'type' => $contentData['type'],
                            'title' => $contentData['title'],
                            'value' => $contentData['value'] ?? null,
                            'duration' => $contentData['duration'] ?? null,
                        ]);

                        $module->contents()->save($content);
                    }
                }
            }

            DB::commit();

            return response()->json(
                [
                    'status' => true,
                    'message' => 'Course created successfull',
                    'course' => $course->load('modules.contents'),
                ],
                201,
            );
        } catch (Exception $e) {
            DB::rollBack();

            return response()->json(
                [
                    'status' => false,
                    'message' => 'Failed to create course.',
                    'error' => $e->getMessage(),
                ],
                500,
            );
        }
    }
}
