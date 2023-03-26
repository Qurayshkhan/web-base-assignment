<?php


namespace App\Services;

use App\Repositories\TeacherRepository;

class TeacherService
{

    protected $teacherRepository;
    public function __construct(TeacherRepository $teacherRepository)
    {
        $this->teacherRepository = $teacherRepository;
    }

    public function createAndUpdateTeacher($data)
    {

      return $this->teacherRepository->storeTeacher($data);

    }

    public function teacherList($request){

        return $this->teacherRepository->getTeachersList($request);

    }
}
