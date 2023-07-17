<?php

namespace App\Services;

use App\Notifications\AssignmentNotification;
use App\Notifications\ResetPasswordNotification;
use App\Notifications\ResultAnnounceOfAssignment;
use Illuminate\Support\Facades\Notification;

class EmailService
{

    public function resetPasswordEmail($user, $url)
    {

        $user->notify(new ResetPasswordNotification($user, $url));
    }

    public function assignmentNotification($course, $student)
    {

        Notification::send($student->user, new AssignmentNotification($course, $student));
    }

    public function resultAnnounceAssignment($student)
    {
        Notification::send($student, new ResultAnnounceOfAssignment($student));
    }
}
