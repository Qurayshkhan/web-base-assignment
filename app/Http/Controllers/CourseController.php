<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Http\Requests\UploadAssignmentRequest;
use App\Models\Course;
use App\Notifications\AssignmentNotification;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{

    protected $emailService, $course;
    public function __construct(EmailService $emailService, Course $course)
    {
        $this->emailService = $emailService;
        $this->course = $course;
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


    public function addEditCourse(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $course = $this->course->updateOrCreate(['name' => $request->name], $request->all());

        if ($course) {
            return response()->json(['message' => 'Course ' . ($request->id ? 'updated' : 'added') . ' successfully']);
        } else {
            return response()->json(['message' => 'Failed to ' . ($request->id ? 'update' : 'add') . ' course'], 500);
        }
    }

    public function destroy($course){

        return $this->course->find($course)->delete();

    }

}
