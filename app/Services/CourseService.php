<?php

namespace App\Services;

use App\Repositories\CourseRepository;

class CourseService
{

    protected $courseRepository;
    public function __construct(CourseRepository $courseRepository)
    {

        $this->courseRepository = $courseRepository;
    }



    public function readAssignment($id){

        return $this->courseRepository->readAssignmentContent($id);

    }


}
