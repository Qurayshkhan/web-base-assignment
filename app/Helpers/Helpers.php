<?php

namespace App\Helpers;

use App\Models\Assignment;
use Illuminate\Support\Facades\Storage;

class Helpers
{


    public static function assignmentUploads($request)
    {


        $file = $request->file('assignment_file');
        $path = $file->storeAs('assignments', $file->getClientOriginalName());
        $url = Storage::url($path);
        // check if an assignment with the same name already exists in the database
        $existingAssignment = Assignment::where('name', $file->getClientOriginalName())->first();

        if ($existingAssignment) {
            // if an assignment with the same name exists, return an error message or handle the error as appropriate
            return 'An assignment with the same name already exists.';
        }

        $assignment = new Assignment();
        $assignment->name = $file->getClientOriginalName();
        $assignment->save();

        return $assignment;
    }
}
