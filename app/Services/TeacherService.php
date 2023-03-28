<?php


namespace App\Services;

use App\Repositories\TeacherRepository;
use Illuminate\Support\Str;

class TeacherService
{

    protected $teacherRepository, $emailService;
    public function __construct(TeacherRepository $teacherRepository, EmailService $emailService)
    {
        $this->teacherRepository = $teacherRepository;
        $this->emailService = $emailService;
    }

    public function createAndUpdateTeacher($data)
    {
        $token =   Str::random(20);

        $data =  [
            'name' => $data['name'],
            'email' => $data['email'],
            'user_id' => $data['user_id'],

            'collage_id' => $data['collage_id'],
            'location' => $data['location'],
            'contact' => $data['contact'],
            "remember_token" => $token,
            'course_name' => $data['course_name']

        ];


        if ($data['user_id']) {
            $this->teacherRepository->storeTeacher($data);
            return "Teacher update successfully";
        } else {
            $teacher = $this->teacherRepository->storeTeacher($data);
            $url = '/reset-password/' . $token . '/' . $teacher->email;
            $this->emailService->resetPasswordEmail($teacher, $url);
            return "Teacher add successfully";
        }
    }

    public function teacherList($request)
    {

        return $this->teacherRepository->getTeachersList($request);
    }

    public function teacherDelete($teacher){

        return $this->teacherRepository->teacherDelete($teacher);

    }

}
