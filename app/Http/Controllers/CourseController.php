<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\Helpers;
use App\Http\Requests\CourseRequest;
use App\Http\Requests\UploadAssignmentRequest;
use App\Models\Collage;
use App\Models\Course;
use App\Models\Teacher;
use App\Notifications\AssignmentNotification;
use App\Services\CourseService;
use App\Services\EmailService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{

    protected $emailService, $course, $courseService;
    public function __construct(EmailService $emailService, Course $course, CourseService $courseService)
    {
        $this->emailService = $emailService;
        $this->course = $course;
        $this->middleware(['role_or_permission:course']);
    }

    public function index()
    {
        $courses = $this->course->all();
        if (auth()->user()->user_type == Constants::COLLAGE) {
            $collageId = Collage::where('user_id', auth()->user()->id)->pluck('id');
            $courses = $this->course->where('collage_id', $collageId)->get();
        }

        if (auth()->user()->user_type == Constants::TEACHER) {

            $teacherId = Teacher::where('user_id', auth()->user()->id)->pluck('id')->first();
            $courses = Course::leftJoin('course_teacher', 'course_teacher.course_id', '=', 'courses.id')
                ->where('course_teacher.teacher_id', $teacherId)
                ->whereHas('students')->get();
        }
        return view('courses.courses', compact('courses'));
    }

    public function uploadAssignment(UploadAssignmentRequest $request)
    {


        $assignments = Helpers::assignmentUploads($request);


        $course = Course::find($request->course_id);

        $course->assignments()->attach(
            $request->course_id,
            [
                'course_id' => $course->id,
                'assignment_id' => $assignments->id

            ]
        );



        $students = $course->students;
        if ($students) {
            foreach ($students as $student) {
                $this->emailService->assignmentNotification($course, $student);
            }
            return "Assignment upload successfully";
        } else {
            return "No Student Select this course";
        }
    }


    public function addEditCourse(Request $request)
    {

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

    public function destroy($course)
    {

        return $this->course->find($course)->delete();
    }
}
