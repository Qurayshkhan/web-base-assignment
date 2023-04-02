<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'path'];


    public function getPathAttribute($value)
    {
        return str_replace('storage', 'public', $value);
    }

    public function setPathAttribute($value)
    {
        $this->attributes['path'] = str_replace('public', 'storage', $value);
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_assignment');
    }
}
