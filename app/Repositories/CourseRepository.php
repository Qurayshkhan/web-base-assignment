<?php

namespace App\Repositories;

use App\Models\Course;

class CourseRepository{


    protected $course;
    public function __construct(Course $course)
    {

        $this->course = $course;

    }

}
