<?php


namespace App\Services;

use App\Repositories\StudentRepository;

class StudentService
{


    protected $studentRepository;

    public function __construct(StudentRepository $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }


    public function getStudentList($request)
    {

        return $this->studentRepository->getStudentList($request);

    }


    public function updateAndCreateStudent($data){

        return $this->studentRepository->updateOrCreateStudent($data);

    }

}
