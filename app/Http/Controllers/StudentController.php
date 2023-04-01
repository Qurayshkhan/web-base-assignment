<?php

namespace App\Http\Controllers;

use App\Models\Collage;
use App\Models\Course;
use App\Models\User;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{

    protected $studentService, $courses, $collage;


    public function __construct(StudentService $studentService, Course $course, Collage $collage)
    {
        $this->studentService = $studentService;
        $this->courses = $course;
        $this->collage = $collage;
        $this->middleware(['role_or_permission:student']);

    }

    public function index()
    {
        $collages = $this->collage->get();
        $courses = $this->courses->get();
        return view('students.students', compact('collages', 'courses'));
    }


    public function getStudents(Request $request)
    {

        return $this->studentService->getStudentList($request);

    }

    public function store(Request $request){


        return $this->studentService->updateAndCreateStudent($request->all());

    }

    public function deleteStudent($student){

        return User::find($student)->delete();

    }


}
