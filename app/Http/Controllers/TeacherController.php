<?php

namespace App\Http\Controllers;

use App\Http\Requests\TeacherRequest;
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
        $this->middleware(['role_or_permission:teacher']);

    }

    public function index()
    {


        $courses = $this->course->get();
        $collages = $this->collage->get();
        if (auth()->user()->user_type == \App\Helpers\Constants::COLLAGE) {

            $collages = $this->collage->where('user_id', auth()->user()->id)->get();
        }

        return view('teachers.teacher', compact('courses', 'collages'));
    }


    public function store(TeacherRequest $request)
    {
        return $this->teacherService->createAndUpdateTeacher($request->all());
    }


    public function getTeacherList(Request $request)
    {

        return $this->teacherService->teacherList($request);
    }


    public function destroy($teacher)
    {

        return $this->teacherService->teacherDelete($teacher);
    }
}
