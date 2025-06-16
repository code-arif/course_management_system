<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Course;
use App\Models\Module;
use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\CourseCreationService;
use App\Http\Requests\StoreCourseRequest;
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
    protected $courseService;

    // Dependency injection
    public function __construct(CourseCreationService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function store(StoreCourseRequest $request)
    {
        try {
            $course = $this->courseService->createCourse($request->validated());

            return response()->json([
                'status' => true,
                'message' => 'Course created successfully',
                'course' => $course,
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to create course',
                'error' => config('app.debug') ? $e->getMessage() : null,
            ], 500);
        }
    }
}
