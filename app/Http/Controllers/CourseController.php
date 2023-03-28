<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadAssignmentRequest;
use App\Models\Course;
use App\Notifications\AssignmentNotification;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class CourseController extends Controller
{

    protected $emailService;
    public function __construct(EmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function index()
    {
        $courses = Course::all();
        return view('courses.courses', compact('courses'));
    }

    public function uploadAssignment(UploadAssignmentRequest $request)
    {

        $course = Course::find($request->course_id);
        $students = $course->students;
        foreach ($students as $student) {
            $this->emailService->assignmentNotification($course, $student);
        }

        return "Assignment upload successfully";
    }
}
