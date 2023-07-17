<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Helpers\Helpers;
use App\Http\Requests\UploadAssignmentRequest;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Collage;
use App\Models\Course;
use App\Models\Teacher;
use App\Services\CourseService;
use App\Services\EmailService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{

    protected $emailService, $course, $courseService, $assignment, $submitAssignment;
    public function __construct(EmailService $emailService, Course $course, CourseService $courseService, Assignment $assignment, AssignmentSubmission $submitAssignment)
    {
        $this->emailService = $emailService;
        $this->course = $course;
        $this->courseService = $courseService;
        $this->assignment = $assignment;
        $this->submitAssignment = $submitAssignment;
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
            $teacherId = Teacher::where('user_id', auth()->user()->id)->pluck('id')->first();
            $courses = Course::with('assignments')->whereHas('teachers', function ($query) use ($teacherId) {
                $query->where('teachers.id', $teacherId);
            })->whereHas('students')->get();
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
                'assignment_id'  =>  intval($assignments->id)

            ]
        );

        $this->assignment->updateOrCreate(
            ['id' => intval($assignments->id)],
            [
                'due_date' => $request->due_date,
                'total_marks' => $request->total_marks,
                // 'results' => $request->results,
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


    public function submitAssignment(Request $request)
    {

        if ($request->hasFile('assignment_file')) {

            $fileName = Helpers::submitAssignment($request);
        }

        $this->submitAssignment->updateOrCreate(['assignment_id' => $request->assignment_id], [

            'student_id' => $request->student_id,
            'assignment_id' => $request->assignment_id,
            'name' => $fileName ?? null,
            'submitted_at' => Carbon::now(),
        ]);

        return response()->json([
            'message' => 'Assignment submit successfully'
        ]);
    }

    public function getContent($id)
    {


        return $this->courseService->readAssignment($id);
    }



    public function destroy($course)
    {

        return $this->course->find($course)->delete();
    }


    public function getCourseAssignment($course)
    {

        $course = $this->course->find($course);
        $assignments = $course->assignments()->get();


        return view('courses.assignments.course-assignments', compact('assignments'));
    }

    public function markAssignmentResult(Request $request)
    {
        $findSubmitAssigment = $this->submitAssignment
            ->where('assignment_id', $request->assignment_id)->where('student_id', $request->student_id)->first();



        $findSubmitAssigment->results = $request->results;
        $findSubmitAssigment->status = 1;
        $findSubmitAssigment->save();

        $this->emailService->resultAnnounceAssignment($findSubmitAssigment->student->user);

        return redirect()->back()->with('status', 'Mark Assignment successfully');
    }
}
