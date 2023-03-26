<?php

namespace App\Services;

use App\Notifications\ResetPasswordNotification;

class EmailService {

        public function resetPasswordEmail($user, $url){

            $user->notify(new ResetPasswordNotification($user, $url));
        }

        public function assignmentNotification(){

        }

}
