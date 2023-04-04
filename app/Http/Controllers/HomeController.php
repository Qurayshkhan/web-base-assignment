<?php

namespace App\Http\Controllers;

use App\Helpers\Constants;
use App\Models\Student;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $courses = $this->studentCourse();
        return view('Dashboard.home', compact('courses'));
    }

    public function completeProfile()
    {

        return view('profiles.complete-profile');
    }

    public function studentCourse()
    {


        if (auth()->user()->user_type == Constants::STUDENT) {
            $student = Student::where('user_id', auth()->user()->id)->first();
            $courses = $student->courses()->get();

            return $courses;
        }
    }
}
