<?php

namespace App\Http\Controllers;

use App\Models\Collage;
use App\Models\Course;
use App\Services\TeacherService;
use Illuminate\Http\Request;

class TeacherController extends Controller
{

    protected $course, $collage, $teacherService;
    public function __construct(Course $course, Collage $collage, TeacherService $teacherService)
    {

        $this->course = $course;
        $this->collage = $collage;
        $this->teacherService = $teacherService;
    }

    public function index()
    {


        $courses = $this->course->get();
        $collages = $this->collage->get();
        return view('teachers.teacher', compact('courses', 'collages'));
    }


    public function store(Request $request)
    {
        $this->teacherService->createAndUpdateTeacher($request->all());
    }


    public function getTeacherList(Request $request){

      return $this->teacherService->teacherList($request);

    }
}
