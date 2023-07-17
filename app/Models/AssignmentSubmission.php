<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubmission extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'assignment_id', 'name', 'submitted_at', 'status', 'results'];


    protected $append = ['status'];


    public function getStatusAttribute($value)
    {
        return $value == 0 ? 'not submitted' : 'submitted';
    }

    public function assignments()
    {

        return $this->belongsTo(Assignment::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
