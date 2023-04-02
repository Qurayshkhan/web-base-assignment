<?php

namespace App\Repositories;

use App\Models\Assignment;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Element\Link;

class CourseRepository
{


    protected $course, $assignment;
    public function __construct(Course $course, Assignment $assignment)
    {

        $this->course = $course;
        $this->assignment = $assignment;
    }



    public function readAssignmentContent($id)
    {
        $assignment = $this->assignment->findOrFail($id);

        // Load the contents of the .docx file into a PHPWord object
        $phpWord = IOFactory::createReader('Word2007')->load(Storage::path($assignment->path));

        // Get the plain text content of the document
        $content = '';
        foreach($phpWord->getSections() as $section) {
            foreach($section->getElements() as $element) {
                if(method_exists($element, 'getText')) {
                    $content .= $element->getText() . "\n";
                }
            }
        }

        // Return the contents as a response with the correct headers
        return response($content)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="' . $assignment->name . '.txt"');


    }
}
