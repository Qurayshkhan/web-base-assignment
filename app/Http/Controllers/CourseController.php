<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Notifications\AssignmentNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CourseController extends Controller
{

    public function index()
    {
        $courses = Course::all();
        return view('courses.courses', compact('courses'));
    }

    public function uploadAssignment(Request $request)
    {

        $course = Course::find($request->course_id);
        $students = $course->students;
        foreach ($students as $student) {

            Notification::send($student->user, new AssignmentNotification());
        }

        return "success";

    }
}
